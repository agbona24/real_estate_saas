<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

/**
 * BlogPost Model
 *
 * Represents a blog post on an agency's website.
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $author_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string|null $featured_image
 * @property string|null $excerpt
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $status
 * @property \Carbon\Carbon|null $published_at
 * @property int $views
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class BlogPost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'author_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'excerpt',
        'meta_title',
        'meta_description',
        'status',
        'published_at',
        'views',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Get the agency (tenant) that owns this blog post.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the author of this blog post.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get all activities for this blog post.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Get the featured image URL.
     */
    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }

        return asset('images/blog-placeholder.png');
    }

    /**
     * Get the meta title or fallback to post title.
     */
    public function getMetaTitleOrDefaultAttribute(): string
    {
        return $this->meta_title ?? $this->title;
    }

    /**
     * Get the meta description or fallback to excerpt or content.
     */
    public function getMetaDescriptionOrDefaultAttribute(): string
    {
        if ($this->meta_description) {
            return $this->meta_description;
        }

        if ($this->excerpt) {
            return Str::limit($this->excerpt, 160);
        }

        return Str::limit(strip_tags($this->content), 160);
    }

    /**
     * Get excerpt or generate from content.
     */
    public function getExcerptOrDefaultAttribute(): string
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }

        return Str::limit(strip_tags($this->content), 200);
    }

    /**
     * Get the reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200); // Average reading speed: 200 words per minute

        return max(1, $minutes);
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft posts.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to order by most recent.
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope a query to order by most viewed.
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Check if post is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' &&
               $this->published_at !== null &&
               $this->published_at->isPast();
    }

    /**
     * Check if post is a draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Publish the post.
     */
    public function publish(): bool
    {
        $this->status = 'published';
        $this->published_at = now();

        return $this->save();
    }

    /**
     * Unpublish the post (convert to draft).
     */
    public function unpublish(): bool
    {
        $this->status = 'draft';

        return $this->save();
    }

    /**
     * Increment view count.
     */
    public function incrementViews(): bool
    {
        return $this->increment('views');
    }
}
