<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Lead Model
 *
 * Represents a potential client in the CRM system.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $assigned_to
 * @property int|null $branch_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string $phone
 * @property string $source
 * @property string $status
 * @property string $priority
 * @property string|null $notes
 * @property array|null $metadata
 * @property \Carbon\Carbon|null $last_contacted_at
 * @property \Carbon\Carbon|null $converted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class Lead extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'assigned_to',
        'branch_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'source',
        'status',
        'priority',
        'notes',
        'metadata',
        'last_contacted_at',
        'converted_at',
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
            'last_contacted_at' => 'datetime',
            'converted_at' => 'datetime',
        ];
    }

    /**
     * Get the agency (tenant) that owns this lead.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the user assigned to this lead.
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the branch this lead is assigned to.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(AgencyBranch::class, 'branch_id');
    }

    /**
     * Get the client created from this lead.
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Get all followups for this lead.
     */
    public function followups(): MorphMany
    {
        return $this->morphMany(Followup::class, 'followupable');
    }

    /**
     * Get all documents for this lead.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get all activities for this lead.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Get the lead's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Scope a query to only include leads by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include new leads.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to only include contacted leads.
     */
    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    /**
     * Scope a query to only include qualified leads.
     */
    public function scopeQualified($query)
    {
        return $query->where('status', 'qualified');
    }

    /**
     * Scope a query to only include won leads.
     */
    public function scopeWon($query)
    {
        return $query->where('status', 'won');
    }

    /**
     * Scope a query to only include lost leads.
     */
    public function scopeLost($query)
    {
        return $query->where('status', 'lost');
    }

    /**
     * Scope a query to only include high priority leads.
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    /**
     * Scope a query to only include leads by source.
     */
    public function scopeBySource($query, string $source)
    {
        return $query->where('source', $source);
    }

    /**
     * Check if lead has been converted to client.
     */
    public function isConverted(): bool
    {
        return $this->converted_at !== null;
    }

    /**
     * Check if lead is new.
     */
    public function isNew(): bool
    {
        return $this->status === 'new';
    }

    /**
     * Check if lead is high priority.
     */
    public function isHighPriority(): bool
    {
        return $this->priority === 'high';
    }

    /**
     * Mark lead as contacted.
     */
    public function markAsContacted(): bool
    {
        $this->status = 'contacted';
        $this->last_contacted_at = now();

        return $this->save();
    }

    /**
     * Convert lead to client.
     */
    public function convertToClient(): bool
    {
        $this->status = 'won';
        $this->converted_at = now();

        return $this->save();
    }
}
