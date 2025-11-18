<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'logo',
        'website',
        'status',
        'description',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the users for the agency.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }

    /**
     * Get the properties for the agency.
     */
    public function properties()
    {
        return $this->hasMany(Property::class, 'tenant_id');
    }

    /**
     * Get the leads for the agency.
     */
    public function leads()
    {
        return $this->hasMany(Lead::class, 'tenant_id');
    }

    /**
     * Get the clients for the agency.
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'tenant_id');
    }
}
