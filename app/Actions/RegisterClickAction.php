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
        $uuid = Request::cookie('visit_uuid');
        
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
