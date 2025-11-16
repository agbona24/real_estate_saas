<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'phone',
        'source',
        'status',
        'priority',
        'assigned_to',
        'created_by',
        'notes',
        'budget',
        'location_preference',
        'property_type_preference',
        'last_contacted_at',
        'converted_at',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'last_contacted_at' => 'datetime',
        'converted_at' => 'datetime',
    ];

    /**
     * Get the agency that owns the lead.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the user assigned to the lead.
     */
    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the user who created the lead.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope a query to only include new leads.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to filter by priority.
     */
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
