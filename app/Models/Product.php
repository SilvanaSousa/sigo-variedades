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
        'is_on_sale',
        'promo_price',
        'image_path',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_on_sale' => 'boolean',
        'price' => 'decimal:2',
        'promo_price' => 'decimal:2',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productViews(): HasMany
    {
        return $this->hasMany(ProductView::class);
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }

    public function hasPromotion(): bool
    {
        return $this->is_on_sale 
            && $this->promo_price !== null 
            && $this->promo_price < $this->price;
    }

    public function displayPrice(): float
    {
        return $this->hasPromotion() ? $this->promo_price : $this->price;
    }

    public function discountPercentage(): ?int
    {
        if (!$this->hasPromotion()) {
            return null;
        }

        return round((($this->price - $this->promo_price) / $this->price) * 100);
    }
}
