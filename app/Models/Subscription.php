<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Subscription Model
 *
 * Represents an agency's subscription to a plan.
 *
 * @property int $id
 * @property int $agency_id
 * @property int $plan_id
 * @property string $status
 * @property \Carbon\Carbon $starts_at
 * @property \Carbon\Carbon $expires_at
 * @property \Carbon\Carbon|null $cancelled_at
 * @property string|null $payment_method
 * @property string|null $payment_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'agency_id',
        'plan_id',
        'status',
        'starts_at',
        'expires_at',
        'cancelled_at',
        'payment_method',
        'payment_id',
        'amount',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'expires_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'amount' => 'decimal:2',
        ];
    }

    /**
     * Get the agency that owns this subscription.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * Get the subscription plan.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }

    /**
     * Get all payments for this subscription.
     */
    public function payments(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    /**
     * Scope a query to only include active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include trial subscriptions.
     */
    public function scopeTrial($query)
    {
        return $query->where('status', 'trial');
    }

    /**
     * Scope a query to only include expired subscriptions.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    /**
     * Scope a query to only include cancelled subscriptions.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope a query to only include subscriptions expiring soon.
     */
    public function scopeExpiringSoon($query, int $days = 7)
    {
        return $query->where('status', 'active')
            ->where('expires_at', '<=', now()->addDays($days))
            ->where('expires_at', '>', now());
    }

    /**
     * Check if subscription is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->expires_at->isFuture();
    }

    /**
     * Check if subscription is on trial.
     */
    public function isTrial(): bool
    {
        return $this->status === 'trial';
    }

    /**
     * Check if subscription has expired.
     */
    public function hasExpired(): bool
    {
        return $this->status === 'expired' || $this->expires_at->isPast();
    }

    /**
     * Check if subscription is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled' && $this->cancelled_at !== null;
    }

    /**
     * Get days remaining until expiration.
     */
    public function getDaysRemainingAttribute(): int
    {
        if ($this->expires_at->isPast()) {
            return 0;
        }

        return now()->diffInDays($this->expires_at);
    }

    /**
     * Cancel the subscription.
     */
    public function cancel(): bool
    {
        $this->status = 'cancelled';
        $this->cancelled_at = now();

        return $this->save();
    }

    /**
     * Renew the subscription.
     */
    public function renew(\Carbon\Carbon $expiresAt): bool
    {
        $this->status = 'active';
        $this->expires_at = $expiresAt;
        $this->cancelled_at = null;

        return $this->save();
    }
}
