<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visit extends Model
{
    protected $fillable = [
        'uuid',
        'ip_hash',
        'user_agent',
        'referer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
    ];

    public function productViews(): HasMany
    {
        return $this->hasMany(ProductView::class);
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }
}
