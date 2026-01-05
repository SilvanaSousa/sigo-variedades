<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Click;
use App\Models\ProductView;
use App\Models\Visit;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Totals
        $totalVisits = Visit::distinct('ip_hash')->count('ip_hash');
        $totalProductViews = ProductView::count();
        $totalClicks = Click::count();

        $ctr = $totalProductViews > 0 
            ? ($totalClicks / $totalProductViews) * 100 
            : 0;

        // Daily Metrics (Last 7 days)
        $visitsPerDay = Visit::selectRaw('DATE(created_at) as date, count(distinct ip_hash) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get()
            ->keyBy('date');

        $viewsPerDay = ProductView::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get()
            ->keyBy('date');

        $clicksPerDay = Click::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get()
            ->keyBy('date');

        // Merge data
        $dailyMetrics = collect();
        for ($i = 0; $i < 7; $i++) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dailyMetrics->push([
                'date' => now()->subDays($i)->format('d/m/Y'),
                'visits' => $visitsPerDay[$date]->count ?? 0,
                'views' => $viewsPerDay[$date]->count ?? 0,
                'clicks' => $clicksPerDay[$date]->count ?? 0,
            ]);
        }

        // Fetch all products with counts once to avoid multiple queries
        $allProducts = \App\Models\Product::withCount(['productViews', 'clicks'])
            ->get()
            ->map(function ($product) {
                // Calculate CTR
                $product->ctr = $product->product_views_count > 0 
                    ? ($product->clicks_count / $product->product_views_count) * 100 
                    : 0;
                return $product;
            });

        // 1. High Performance (High CTR) - Minimum verified interest (e.g. > 3 views)
        $highCtrProducts = $allProducts
            ->filter(fn($p) => $p->product_views_count > 3)
            ->sortByDesc('ctr')
            ->take(5);

        // 2. Most Popular (Top Clicks)
        $topClickedProducts = $allProducts
            ->sortByDesc('clicks_count')
            ->take(5);

        // 3. Opportunities (High Views, Low CTR) - Problematic
        // Filter: Above average views but below average CTR ?
        // Simple heuristic: > 5 views, sort by CTR ASC
        $lowConversionProducts = $allProducts
            ->filter(fn($p) => $p->product_views_count > 5)
            ->sortBy('ctr')
            ->take(5);

        return view('admin.dashboard.index', compact(
            'totalVisits',
            'totalProductViews',
            'totalClicks',
            'ctr',
            'dailyMetrics',
            'highCtrProducts',
            'topClickedProducts',
            'lowConversionProducts'
        ));
    }


}
