<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agency) {
            if (empty($agency->slug)) {
                $agency->slug = Str::slug($agency->name);
            }
        });
    }

    /**
     * Get all menus for this agency.
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'tenant_id');
    }

    /**
     * Scope a query to only include active agencies.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
