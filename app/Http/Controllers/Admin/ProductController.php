<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.products.index', compact('products', 'categories', 'brands', 'colors'));
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'images.*' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'price1' => 'required|numeric',
            'price2' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'size' => 'nullable|string',
            'color' => 'nullable|array',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }
        $validatedData['image'] = $imagePaths;

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'colors'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'images.*' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'price1' => 'required|numeric',
            'price2' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'size' => 'nullable|string',
            'color' => 'nullable|array',
        ]);

        $imagePaths = $product->image ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }
        $validatedData['image'] = $imagePaths;

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            foreach ($product->image as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
