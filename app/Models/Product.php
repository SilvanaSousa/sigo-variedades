<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'affiliate_url',
        'category_id',
        'is_active',
        'image_path',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(ProductView::class);
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }
}
