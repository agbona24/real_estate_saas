<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'name',
        'location',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the agency (tenant) that owns the menu.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get all menu items for this menu.
     */
    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    /**
     * Get only top-level menu items (no parent).
     */
    public function topLevelItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)
            ->whereNull('parent_id')
            ->orderBy('sort_order');
    }

    /**
     * Scope a query to only include active menus.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by location.
     */
    public function scopeLocation($query, string $location)
    {
        return $query->where('location', $location);
    }
}
