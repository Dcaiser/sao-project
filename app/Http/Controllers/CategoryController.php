<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Activity;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Category::create($data);
        activity::create([
            'name' => auth()->user()->name,
            'role' => auth()->user()->role,
            'activity' => 'Menambahkan kategori',
            'object' => $data['name'],
        ]);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.category-edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->update($data);
        activity::create([
            'name' => auth()->user()->name,
            'role' => auth()->user()->role,
            'activity' => 'Memperbarui kategori',
            'object' => $data['name'],
        ]);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        activity::create([
            'name' => auth()->user()->name,
            'role' => auth()->user()->role,
            'activity' => 'Menghapus kategori',
            'object' => $category->name,
        ]);
        return redirect()->route('admin.categories.index')->with('status', 'Kategori berhasil dihapus.');
    }
}
