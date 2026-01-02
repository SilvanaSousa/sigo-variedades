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
        $totalVisits = Visit::count();
        $totalProductViews = ProductView::count();
        $totalClicks = Click::count();

        $ctr = $totalProductViews > 0 
            ? ($totalClicks / $totalProductViews) * 100 
            : 0;

        return view('admin.dashboard.index', compact(
            'totalVisits',
            'totalProductViews',
            'totalClicks',
            'ctr'
        ));
    }
}
