<?php

namespace App\Http\Controllers;

use App\Events\ProductViewed;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::where('is_active', true)->with('category');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        
        $categories = \App\Models\Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        ProductViewed::dispatch($product);

        return view('products.show', compact('product'));
    }
}
