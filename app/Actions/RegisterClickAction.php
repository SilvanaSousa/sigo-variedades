<?php

namespace App\Actions;

use App\Models\Click;
use App\Models\Product;
use App\Models\Visit;
use Illuminate\Support\Facades\Request;

class RegisterClickAction
{
    public function execute(Product $product): void
    {
        // Get UUID injected by middleware (works because RedirectController is web route)
        $uuid = request()->attributes->get('visit_uuid');
        
        if (!$uuid) {
            return;
        }

        $visit = Visit::where('uuid', $uuid)->latest()->first();

        if ($visit) {
            Click::create([
                'visit_id' => $visit->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
