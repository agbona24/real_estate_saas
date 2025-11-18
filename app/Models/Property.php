<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Property Model
 *
 * Represents a real estate property listing.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $branch_id
 * @property int $created_by
 * @property string $title
 * @property string $slug
 * @property string $type
 * @property string $listing_type
 * @property float $price
 * @property int|null $bedrooms
 * @property int|null $bathrooms
 * @property float|null $size
 * @property string $size_unit
 * @property string|null $description
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string|null $zip_code
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $status
 * @property bool $is_featured
 * @property array|null $features
 * @property array|null $metadata
 * @property int $views
 * @property \Carbon\Carbon|null $published_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class Property extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'branch_id',
        'created_by',
        'title',
        'slug',
        'type',
        'listing_type',
        'price',
        'bedrooms',
        'bathrooms',
        'size',
        'size_unit',
        'description',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'latitude',
        'longitude',
        'status',
        'is_featured',
        'features',
        'metadata',
        'views',
        'published_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'size' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'is_featured' => 'boolean',
            'features' => 'array',
            'metadata' => 'array',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title);
            }
        });
    }

    /**
     * Get the agency (tenant) that owns this property.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the branch this property belongs to.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(AgencyBranch::class, 'branch_id');
    }

    /**
     * Get the user who created this property.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all media for this property.
     */
    public function media(): HasMany
    {
        return $this->hasMany(PropertyMedia::class);
    }

    /**
     * Get all images for this property.
     */
    public function images(): HasMany
    {
        return $this->hasMany(PropertyMedia::class)->where('type', 'image');
    }

    /**
     * Get the primary image for this property.
     */
    public function primaryImage(): HasMany
    {
        return $this->hasMany(PropertyMedia::class)
            ->where('type', 'image')
            ->where('is_primary', true);
    }

    /**
     * Get all transactions for this property.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get all inquiries for this property.
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * Get all documents for this property.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get all activities for this property.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Get the full address of the property.
     */
    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->zip_code,
            $this->country,
        ]);

        return implode(', ', $parts);
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return '₦' . number_format($this->price, 2);
    }

    /**
     * Scope a query to only include published properties.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'available')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include available properties.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope a query to only include sold properties.
     */
    public function scopeSold($query)
    {
        return $query->where('status', 'sold');
    }

    /**
     * Scope a query to only include rented properties.
     */
    public function scopeRented($query)
    {
        return $query->where('status', 'rented');
    }

    /**
     * Scope a query to only include featured properties.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by property type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to filter by listing type.
     */
    public function scopeForListingType($query, string $listingType)
    {
        return $query->where('listing_type', $listingType);
    }

    /**
     * Scope a query to filter by price range.
     */
    public function scopePriceBetween($query, float $min, float $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    /**
     * Scope a query to filter by location.
     */
    public function scopeInCity($query, string $city)
    {
        return $query->where('city', 'LIKE', "%{$city}%");
    }

    /**
     * Check if property is available.
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    /**
     * Check if property is sold.
     */
    public function isSold(): bool
    {
        return $this->status === 'sold';
    }

    /**
     * Check if property is rented.
     */
    public function isRented(): bool
    {
        return $this->status === 'rented';
    }

    /**
     * Check if property is published.
     */
    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }

    /**
     * Check if property is for sale.
     */
    public function isForSale(): bool
    {
        return $this->listing_type === 'sale';
    }

    /**
     * Check if property is for rent.
     */
    public function isForRent(): bool
    {
        return $this->listing_type === 'rent';
    }

    /**
     * Increment view count.
     */
    public function incrementViews(): bool
    {
        return $this->increment('views');
    }

    /**
     * Publish the property.
     */
    public function publish(): bool
    {
        $this->published_at = now();
        $this->status = 'available';

        return $this->save();
    }

    /**
     * Mark property as sold.
     */
    public function markAsSold(): bool
    {
        $this->status = 'sold';

        return $this->save();
    }

    /**
     * Mark property as rented.
     */
    public function markAsRented(): bool
    {
        $this->status = 'rented';

        return $this->save();
    }
}
