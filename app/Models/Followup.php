<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Followup Model
 *
 * Represents a followup task that can be attached to various entities (polymorphic).
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $followupable_type
 * @property int $followupable_id
 * @property int $user_id
 * @property string $type
 * @property string $notes
 * @property \Carbon\Carbon|null $scheduled_at
 * @property \Carbon\Carbon|null $completed_at
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Followup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'followupable_type',
        'followupable_id',
        'user_id',
        'type',
        'notes',
        'scheduled_at',
        'completed_at',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    /**
     * Get the agency (tenant) that owns this followup.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the user assigned to this followup.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent followupable model (lead, client, property, etc.).
     */
    public function followupable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include pending followups.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include completed followups.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include cancelled followups.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include scheduled followups.
     */
    public function scopeScheduled($query)
    {
        return $query->whereNotNull('scheduled_at');
    }

    /**
     * Scope a query to only include overdue followups.
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'pending')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<', now());
    }

    /**
     * Scope a query to only include upcoming followups.
     */
    public function scopeUpcoming($query, int $days = 7)
    {
        return $query->where('status', 'pending')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '>', now())
            ->where('scheduled_at', '<=', now()->addDays($days));
    }

    /**
     * Scope a query to only include today's followups.
     */
    public function scopeToday($query)
    {
        return $query->where('status', 'pending')
            ->whereNotNull('scheduled_at')
            ->whereDate('scheduled_at', today());
    }

    /**
     * Scope a query to filter by user.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Check if followup is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if followup is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if followup is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if followup is overdue.
     */
    public function isOverdue(): bool
    {
        if (!$this->scheduled_at || $this->status !== 'pending') {
            return false;
        }

        return $this->scheduled_at->isPast();
    }

    /**
     * Check if followup is scheduled for today.
     */
    public function isDueToday(): bool
    {
        if (!$this->scheduled_at || $this->status !== 'pending') {
            return false;
        }

        return $this->scheduled_at->isToday();
    }

    /**
     * Mark followup as completed.
     */
    public function markAsCompleted(): bool
    {
        $this->status = 'completed';
        $this->completed_at = now();

        return $this->save();
    }

    /**
     * Cancel the followup.
     */
    public function cancel(): bool
    {
        $this->status = 'cancelled';

        return $this->save();
    }

    /**
     * Reschedule the followup.
     */
    public function reschedule(\Carbon\Carbon $scheduledAt): bool
    {
        $this->scheduled_at = $scheduledAt;
        $this->status = 'pending';

        return $this->save();
    }
}
