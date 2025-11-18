<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'title',
        'slug',
        'description',
        'category_id',
        'type',
        'status',
        'price',
        'price_period',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'area',
        'area_unit',
        'year_built',
        'created_by',
        'is_featured',
        'is_published',
        'view_count',
        'amenities',
        'published_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'area' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'amenities' => 'array',
        'published_at' => 'datetime',
    ];

    /**
     * Get the agency that owns the property.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the user who created the property.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope a query to only include published properties.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include featured properties.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
