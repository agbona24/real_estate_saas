<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

/**
 * Payment Model
 *
 * Represents a payment that can be attached to various entities (polymorphic).
 *
 * @property int $id
 * @property int|null $tenant_id
 * @property string $payable_type
 * @property int $payable_id
 * @property string $payment_reference
 * @property float $amount
 * @property string $type
 * @property string $status
 * @property string|null $payment_method
 * @property string|null $transaction_id
 * @property string|null $description
 * @property array|null $metadata
 * @property \Carbon\Carbon|null $paid_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'payable_type',
        'payable_id',
        'payment_reference',
        'amount',
        'type',
        'status',
        'payment_method',
        'transaction_id',
        'description',
        'metadata',
        'paid_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'metadata' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->payment_reference)) {
                $payment->payment_reference = self::generatePaymentReference();
            }
        });
    }

    /**
     * Generate a unique payment reference.
     */
    protected static function generatePaymentReference(): string
    {
        do {
            $reference = 'PAY-' . strtoupper(Str::random(3)) . '-' . date('ymd') . '-' . rand(1000, 9999);
        } while (self::where('payment_reference', $reference)->exists());

        return $reference;
    }

    /**
     * Get the agency (tenant) that owns this payment.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the parent payable model (subscription, transaction, etc.).
     */
    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return '₦' . number_format($this->amount, 2);
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include processing payments.
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    /**
     * Scope a query to only include completed payments.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include failed payments.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope a query to only include refunded payments.
     */
    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include subscription payments.
     */
    public function scopeSubscription($query)
    {
        return $query->where('type', 'subscription');
    }

    /**
     * Scope a query to only include property payments.
     */
    public function scopeProperty($query)
    {
        return $query->where('type', 'property');
    }

    /**
     * Scope a query to only include commission payments.
     */
    public function scopeCommission($query)
    {
        return $query->where('type', 'commission');
    }

    /**
     * Check if payment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment is processing.
     */
    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    /**
     * Check if payment is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if payment has failed.
     */
    public function hasFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Check if payment is refunded.
     */
    public function isRefunded(): bool
    {
        return $this->status === 'refunded';
    }

    /**
     * Mark payment as completed.
     */
    public function markAsCompleted(string $transactionId = null): bool
    {
        $this->status = 'completed';
        $this->paid_at = now();

        if ($transactionId) {
            $this->transaction_id = $transactionId;
        }

        return $this->save();
    }

    /**
     * Mark payment as failed.
     */
    public function markAsFailed(): bool
    {
        $this->status = 'failed';

        return $this->save();
    }

    /**
     * Mark payment as refunded.
     */
    public function markAsRefunded(): bool
    {
        $this->status = 'refunded';

        return $this->save();
    }

    /**
     * Mark payment as processing.
     */
    public function markAsProcessing(): bool
    {
        $this->status = 'processing';

        return $this->save();
    }
}
