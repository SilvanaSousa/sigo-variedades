<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name) . '-' . Str::random(6);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        if ($request->name !== $product->name) {
             $data['slug'] = Str::slug($request->name) . '-' . Str::random(6);
        }
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
             // Delete old image if exists
            if ($product->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
