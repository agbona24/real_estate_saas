<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Inquiry Model
 *
 * Represents a contact inquiry from the website.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $property_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $message
 * @property string $type
 * @property string $status
 * @property \Carbon\Carbon|null $read_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Inquiry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'property_id',
        'name',
        'email',
        'phone',
        'message',
        'type',
        'status',
        'read_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    /**
     * Get the agency (tenant) that received this inquiry.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the property this inquiry is about.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get all activities for this inquiry.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include new inquiries.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to only include read inquiries.
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope a query to only include replied inquiries.
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Scope a query to only include closed inquiries.
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include property inquiries.
     */
    public function scopeProperty($query)
    {
        return $query->where('type', 'property');
    }

    /**
     * Scope a query to only include general inquiries.
     */
    public function scopeGeneral($query)
    {
        return $query->where('type', 'general');
    }

    /**
     * Scope a query to only include valuation inquiries.
     */
    public function scopeValuation($query)
    {
        return $query->where('type', 'valuation');
    }

    /**
     * Scope a query to only include unread inquiries.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope a query to order by most recent.
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Check if inquiry is new.
     */
    public function isNew(): bool
    {
        return $this->status === 'new';
    }

    /**
     * Check if inquiry has been read.
     */
    public function isRead(): bool
    {
        return $this->status === 'read' || $this->read_at !== null;
    }

    /**
     * Check if inquiry has been replied to.
     */
    public function isReplied(): bool
    {
        return $this->status === 'replied';
    }

    /**
     * Check if inquiry is closed.
     */
    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    /**
     * Check if inquiry is unread.
     */
    public function isUnread(): bool
    {
        return $this->read_at === null;
    }

    /**
     * Check if inquiry is related to a property.
     */
    public function isPropertyInquiry(): bool
    {
        return $this->type === 'property' && $this->property_id !== null;
    }

    /**
     * Mark inquiry as read.
     */
    public function markAsRead(): bool
    {
        $this->status = 'read';
        $this->read_at = now();

        return $this->save();
    }

    /**
     * Mark inquiry as replied.
     */
    public function markAsReplied(): bool
    {
        $this->status = 'replied';

        if (!$this->read_at) {
            $this->read_at = now();
        }

        return $this->save();
    }

    /**
     * Close the inquiry.
     */
    public function close(): bool
    {
        $this->status = 'closed';

        return $this->save();
    }

    /**
     * Reopen the inquiry.
     */
    public function reopen(): bool
    {
        $this->status = 'new';

        return $this->save();
    }
}
