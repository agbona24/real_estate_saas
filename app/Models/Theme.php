<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Theme Model
 *
 * Represents a website theme that agencies can use for their websites.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $thumbnail
 * @property string $version
 * @property string|null $author
 * @property array|null $config
 * @property bool $is_active
 * @property bool $is_default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Theme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'version',
        'author',
        'config',
        'is_active',
        'is_default',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'config' => 'array',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($theme) {
            if (empty($theme->slug)) {
                $theme->slug = Str::slug($theme->name);
            }
        });

        static::saving(function ($theme) {
            // Ensure only one theme is marked as default
            if ($theme->is_default) {
                self::where('id', '!=', $theme->id)
                    ->update(['is_default' => false]);
            }
        });
    }

    /**
     * Get the thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        return asset('images/theme-placeholder.png');
    }

    /**
     * Get a specific config value.
     */
    public function getConfig(string $key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }

    /**
     * Set a specific config value.
     */
    public function setConfig(string $key, $value): void
    {
        $config = $this->config ?? [];
        data_set($config, $key, $value);
        $this->config = $config;
    }

    /**
     * Scope a query to only include active themes.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include the default theme.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Check if this is the default theme.
     */
    public function isDefault(): bool
    {
        return $this->is_default;
    }

    /**
     * Check if theme is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Activate the theme.
     */
    public function activate(): bool
    {
        $this->is_active = true;

        return $this->save();
    }

    /**
     * Deactivate the theme.
     */
    public function deactivate(): bool
    {
        // Don't allow deactivating the default theme
        if ($this->is_default) {
            return false;
        }

        $this->is_active = false;

        return $this->save();
    }

    /**
     * Set this theme as default.
     */
    public function setAsDefault(): bool
    {
        $this->is_default = true;
        $this->is_active = true;

        return $this->save();
    }
}
