<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::where('is_active', true)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $categories = \App\Models\Category::withCount('products')->get();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
