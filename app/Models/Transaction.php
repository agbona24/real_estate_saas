<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

/**
 * Transaction Model
 *
 * Represents a property transaction (sale, rental, or lease).
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $property_id
 * @property int $client_id
 * @property int $realtor_id
 * @property string $transaction_number
 * @property string $type
 * @property float $amount
 * @property float|null $commission_rate
 * @property float|null $commission_amount
 * @property string $status
 * @property \Carbon\Carbon|null $start_date
 * @property \Carbon\Carbon|null $completion_date
 * @property string|null $notes
 * @property array|null $metadata
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tenant_id',
        'property_id',
        'client_id',
        'realtor_id',
        'transaction_number',
        'type',
        'amount',
        'commission_rate',
        'commission_amount',
        'status',
        'start_date',
        'completion_date',
        'notes',
        'metadata',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'commission_rate' => 'decimal:2',
            'commission_amount' => 'decimal:2',
            'start_date' => 'date',
            'completion_date' => 'date',
            'metadata' => 'array',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_number)) {
                $transaction->transaction_number = self::generateTransactionNumber();
            }
        });
    }

    /**
     * Generate a unique transaction number.
     */
    protected static function generateTransactionNumber(): string
    {
        do {
            $number = 'TXN-' . strtoupper(Str::random(3)) . '-' . date('ymd') . '-' . rand(1000, 9999);
        } while (self::where('transaction_number', $number)->exists());

        return $number;
    }

    /**
     * Get the agency (tenant) that owns this transaction.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }

    /**
     * Get the property for this transaction.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the client for this transaction.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the realtor handling this transaction.
     */
    public function realtor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'realtor_id');
    }

    /**
     * Get all payments for this transaction.
     */
    public function payments(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    /**
     * Get all documents for this transaction.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get all activities for this transaction.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Get the formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return '₦' . number_format($this->amount, 2);
    }

    /**
     * Get the formatted commission amount.
     */
    public function getFormattedCommissionAttribute(): string
    {
        if (!$this->commission_amount) {
            return 'N/A';
        }

        return '₦' . number_format($this->commission_amount, 2);
    }

    /**
     * Scope a query to only include transactions by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include pending transactions.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include in-progress transactions.
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in-progress');
    }

    /**
     * Scope a query to only include completed transactions.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include cancelled transactions.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Check if transaction is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if transaction is in progress.
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in-progress';
    }

    /**
     * Check if transaction is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if transaction is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Calculate commission amount based on rate.
     */
    public function calculateCommission(): void
    {
        if ($this->commission_rate) {
            $this->commission_amount = ($this->amount * $this->commission_rate) / 100;
        }
    }

    /**
     * Mark transaction as completed.
     */
    public function markAsCompleted(): bool
    {
        $this->status = 'completed';
        $this->completion_date = now();

        return $this->save();
    }

    /**
     * Cancel the transaction.
     */
    public function cancel(): bool
    {
        $this->status = 'cancelled';

        return $this->save();
    }
}
