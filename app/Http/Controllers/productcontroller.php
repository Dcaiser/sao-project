<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::orderBy('name')->get();

        $categoriesWithProducts = Category::with(['products' => function ($query) {
            $query->orderBy('name');
        }])->orderBy('name')->get();

        return view('admin.product', compact('products', 'categories', 'categoriesWithProducts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'stock' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        Activity::create([
            'name' => auth()->user()->name,
            'role' => auth()->user()->role,
            'activity' => 'Menambahkan produk',
            'object' => $data['name'],
        ]);

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $product->load('category');
        $categories = Category::orderBy('name')->get();


        return view('admin.product-edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'stock' => ['required', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        Activity::create([
            'name' => auth()->user()->name,
            'role' => auth()->user()->role,
            'activity' => 'Memperbarui produk',
            'object' => $data['name'],
        ]);

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        Activity::create([
            'name' => auth()->user()->name,
            'role' => auth()->user()->role,
            'activity' => 'Menghapus produk',
            'object' => $product->name,
        ]);

        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil dihapus.');
    }
}
