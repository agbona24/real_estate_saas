<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Agency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'logo',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'website',
        'description',
        'status',
        'subdomain',
        'custom_domain',
        'settings',
        'subscribed_at',
        'subscription_expires_at',
    ];

    protected $casts = [
        'settings' => 'array',
        'subscribed_at' => 'datetime',
        'subscription_expires_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agency) {
            if (empty($agency->slug)) {
                $agency->slug = Str::slug($agency->name);
            }
            if (empty($agency->subdomain)) {
                $agency->subdomain = Str::slug($agency->name);
            }
        });
    }

    /**
     * Get all users belonging to this agency.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }

    /**
     * Get all branches of this agency.
     */
    public function branches()
    {
        return $this->hasMany(AgencyBranch::class);
    }

    /**
     * Get all properties of this agency.
     */
    public function properties()
    {
        return $this->hasMany(Property::class, 'tenant_id');
    }

    /**
     * Get all leads of this agency.
     */
    public function leads()
    {
        return $this->hasMany(Lead::class, 'tenant_id');
    }

    /**
     * Get all clients of this agency.
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'tenant_id');
    }

    /**
     * Get the active subscription.
     */
    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->latest();
    }

    /**
     * Check if agency subscription is active.
     */
    public function isSubscriptionActive(): bool
    {
        return $this->status === 'active' &&
               $this->subscription_expires_at &&
               $this->subscription_expires_at->isFuture();
    }
}
