<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'type',
        'company_name',
        'assigned_to',
        'converted_from_lead_id',
        'status',
        'notes',
    ];

    /**
     * Get the agency that owns the client.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the user account linked to this client.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the agent assigned to this client.
     */
    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the lead this client was converted from.
     */
    public function convertedFromLead()
    {
        return $this->belongsTo(Lead::class, 'converted_from_lead_id');
    }

    /**
     * Scope a query to only include active clients.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }
}
