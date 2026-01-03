<?php

namespace App\Listeners;

use App\Events\ProductViewed;
use App\Models\ProductView;
use App\Models\Visit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Request;

class TrackProductViewListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductViewed $event): void
    {
        // Get UUID injected by middleware
        $uuid = request()->attributes->get('visit_uuid');
        
        if (!$uuid) {
            return;
        }

        $visit = Visit::where('uuid', $uuid)->latest()->first();

        if ($visit) {
            // Check if this IP has already viewed this product
            $alreadyViewed = ProductView::where('product_id', $event->product->id)
                ->whereHas('visit', function ($query) use ($visit) {
                    $query->where('ip_hash', $visit->ip_hash);
                })
                ->exists();

            if (!$alreadyViewed) {
                ProductView::create([
                    'visit_id' => $visit->id,
                    'product_id' => $event->product->id,
                ]);
            }
        }
    }
}
