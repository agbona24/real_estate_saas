<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'label',
        'url',
        'parent_id',
        'sort_order',
        'open_new_tab',
        'icon',
    ];

    protected $casts = [
        'open_new_tab' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the menu that owns the menu item.
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the parent menu item.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Get the child menu items (submenu).
     */
    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->orderBy('sort_order');
    }

    /**
     * Check if this menu item has children.
     */
    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Check if this is a top-level menu item.
     */
    public function isTopLevel(): bool
    {
        return is_null($this->parent_id);
    }
}
