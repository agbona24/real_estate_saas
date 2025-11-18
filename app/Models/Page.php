<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Page Model
 *
 * Represents a custom page on an agency's website.
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $title
 * @property string $slug
 * @property string|null $content
 * @property array|null $sections
 * @property string $template
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string $status
 * @property bool $is_homepage
 * @property int $order
 * @property \Carbon\Carbon|null $published_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Page extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'title',
        'slug',
        'content',
        'sections',
        'template',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'is_homepage',
        'order',
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
            'sections' => 'array',
            'is_homepage' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::saving(function ($page) {
            // Ensure only one page is marked as homepage per tenant
            if ($page->is_homepage) {
                self::where('tenant_id', $page->tenant_id)
                    ->where('id', '!=', $page->id)
                    ->update(['is_homepage' => false]);
            }
        });
    }

    /**
     * Get the agency (tenant) that owns this page.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the meta title or fallback to page title.
     */
    public function getMetaTitleOrDefaultAttribute(): string
    {
        return $this->meta_title ?? $this->title;
    }

    /**
     * Get the meta description or generate from content.
     */
    public function getMetaDescriptionOrDefaultAttribute(): string
    {
        if ($this->meta_description) {
            return $this->meta_description;
        }

        if ($this->content) {
            return Str::limit(strip_tags($this->content), 160);
        }

        return '';
    }

    /**
     * Scope a query to only include published pages.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft pages.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to only include the homepage.
     */
    public function scopeHomepage($query)
    {
        return $query->where('is_homepage', true);
    }

    /**
     * Scope a query to order pages by their order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Check if page is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' &&
               $this->published_at !== null &&
               $this->published_at->isPast();
    }

    /**
     * Check if page is a draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if this is the homepage.
     */
    public function isHomepage(): bool
    {
        return $this->is_homepage;
    }

    /**
     * Publish the page.
     */
    public function publish(): bool
    {
        $this->status = 'published';
        $this->published_at = now();

        return $this->save();
    }

    /**
     * Unpublish the page (convert to draft).
     */
    public function unpublish(): bool
    {
        $this->status = 'draft';

        return $this->save();
    }

    /**
     * Set this page as homepage.
     */
    public function setAsHomepage(): bool
    {
        $this->is_homepage = true;
        $this->status = 'published';
        $this->published_at = $this->published_at ?? now();

        return $this->save();
    }

    /**
     * Get a specific section by key.
     */
    public function getSection(string $key, $default = null)
    {
        return data_get($this->sections, $key, $default);
    }

    /**
     * Set a specific section value.
     */
    public function setSection(string $key, $value): void
    {
        $sections = $this->sections ?? [];
        data_set($sections, $key, $value);
        $this->sections = $sections;
    }
}
