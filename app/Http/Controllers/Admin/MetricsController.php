<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Click;
use App\Models\ProductView;
use App\Models\Visit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class MetricsController extends Controller
{
    public function reset(): RedirectResponse
    {
        DB::transaction(function () {
            // Reset destructively but safely within a transaction
            Visit::truncate();
            ProductView::truncate();
            Click::truncate();
        });

        return back()->with('success', 'Todas as métricas foram resetadas com sucesso.');
    }
}
