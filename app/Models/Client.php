<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Client Model
 *
 * Represents a client in the system.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $user_id
 * @property int|null $lead_id
 * @property int|null $assigned_to
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string $phone
 * @property string|null $company
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string $type
 * @property string|null $notes
 * @property array|null $metadata
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class Client extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'user_id',
        'lead_id',
        'assigned_to',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'address',
        'city',
        'state',
        'country',
        'type',
        'notes',
        'metadata',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    /**
     * Get the agency (tenant) that owns this client.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the user account associated with this client.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lead that was converted to this client.
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the user assigned to this client.
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all transactions for this client.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all followups for this client.
     */
    public function followups(): MorphMany
    {
        return $this->morphMany(Followup::class, 'followupable');
    }

    /**
     * Get all documents for this client.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get all activities for this client.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Get the client's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the full address of the client.
     */
    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->country,
        ]);

        return implode(', ', $parts);
    }

    /**
     * Scope a query to only include clients by type.
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include buyers.
     */
    public function scopeBuyers($query)
    {
        return $query->where('type', 'buyer');
    }

    /**
     * Scope a query to only include sellers.
     */
    public function scopeSellers($query)
    {
        return $query->where('type', 'seller');
    }

    /**
     * Scope a query to only include renters.
     */
    public function scopeRenters($query)
    {
        return $query->where('type', 'renter');
    }

    /**
     * Scope a query to only include landlords.
     */
    public function scopeLandlords($query)
    {
        return $query->where('type', 'landlord');
    }

    /**
     * Check if client is a buyer.
     */
    public function isBuyer(): bool
    {
        return $this->type === 'buyer';
    }

    /**
     * Check if client is a seller.
     */
    public function isSeller(): bool
    {
        return $this->type === 'seller';
    }

    /**
     * Check if client is a renter.
     */
    public function isRenter(): bool
    {
        return $this->type === 'renter';
    }

    /**
     * Check if client is a landlord.
     */
    public function isLandlord(): bool
    {
        return $this->type === 'landlord';
    }

    /**
     * Check if client was converted from a lead.
     */
    public function isConvertedFromLead(): bool
    {
        return $this->lead_id !== null;
    }
}
