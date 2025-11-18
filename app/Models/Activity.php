<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Activity Model
 *
 * Represents an activity log entry for tracking actions in the system.
 *
 * @property int $id
 * @property int|null $tenant_id
 * @property int|null $user_id
 * @property string $event
 * @property string $subject_type
 * @property int $subject_id
 * @property string $description
 * @property array|null $properties
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'user_id',
        'event',
        'subject_type',
        'subject_id',
        'description',
        'properties',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'properties' => 'array',
        ];
    }

    /**
     * Get the agency (tenant) that owns this activity.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the user who performed this activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject model (the entity this activity is about).
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get a specific property value from the properties array.
     */
    public function getProperty(string $key, $default = null)
    {
        return data_get($this->properties, $key, $default);
    }

    /**
     * Get the user name or 'System' if no user.
     */
    public function getUserNameAttribute(): string
    {
        return $this->user ? $this->user->full_name : 'System';
    }

    /**
     * Scope a query to filter by event.
     */
    public function scopeByEvent($query, string $event)
    {
        return $query->where('event', $event);
    }

    /**
     * Scope a query to filter by user.
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to filter by tenant.
     */
    public function scopeByTenant($query, int $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    /**
     * Scope a query to filter by subject type.
     */
    public function scopeForSubjectType($query, string $subjectType)
    {
        return $query->where('subject_type', $subjectType);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Scope a query to get recent activities.
     */
    public function scopeRecent($query, int $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Scope a query to get activities from today.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope a query to get activities from this week.
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ]);
    }

    /**
     * Scope a query to get activities from this month.
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    /**
     * Log an activity.
     *
     * @param string $event
     * @param Model $subject
     * @param string $description
     * @param array $properties
     * @param int|null $tenantId
     * @param int|null $userId
     * @return static
     */
    public static function log(
        string $event,
        Model $subject,
        string $description,
        array $properties = [],
        ?int $tenantId = null,
        ?int $userId = null
    ): self {
        return self::create([
            'tenant_id' => $tenantId ?? (auth()->check() && auth()->user()->tenant_id ? auth()->user()->tenant_id : null),
            'user_id' => $userId ?? (auth()->check() ? auth()->id() : null),
            'event' => $event,
            'subject_type' => get_class($subject),
            'subject_id' => $subject->id,
            'description' => $description,
            'properties' => $properties,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Get browser name from user agent.
     */
    public function getBrowserAttribute(): string
    {
        if (!$this->user_agent) {
            return 'Unknown';
        }

        if (str_contains($this->user_agent, 'Chrome')) {
            return 'Chrome';
        } elseif (str_contains($this->user_agent, 'Firefox')) {
            return 'Firefox';
        } elseif (str_contains($this->user_agent, 'Safari')) {
            return 'Safari';
        } elseif (str_contains($this->user_agent, 'Edge')) {
            return 'Edge';
        }

        return 'Unknown';
    }

    /**
     * Get platform from user agent.
     */
    public function getPlatformAttribute(): string
    {
        if (!$this->user_agent) {
            return 'Unknown';
        }

        if (str_contains($this->user_agent, 'Windows')) {
            return 'Windows';
        } elseif (str_contains($this->user_agent, 'Mac')) {
            return 'macOS';
        } elseif (str_contains($this->user_agent, 'Linux')) {
            return 'Linux';
        } elseif (str_contains($this->user_agent, 'Android')) {
            return 'Android';
        } elseif (str_contains($this->user_agent, 'iOS')) {
            return 'iOS';
        }

        return 'Unknown';
    }
}
