<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Storage;

class CategoryController extends BaseAdminController
{
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $data = [
            'key' => $validated['key'],
            'parent_id' => $validated['parent_id'] ?? null,
        ];

        if (isset($validated['image'])) {
            $data['image'] = $validated['image']->store('public/images');
        }
        $category = Category::create($data);

        $category->addTranslations($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        $category->load('products');
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $data = [
            'key' => $validated['key'],
            'parent_id' => $validated['parent_id'] ?? null,
        ];

        if (isset($validated['image'])) {
            if ($category->image && Storage::exists($category->image)) {
                Storage::delete($category->image);
            }
            $data['image'] = $validated['image']->store('public/images');
        }
        $category->update([
            'key' => $data['key'],
            'image' => $data['image'] ?? $category->image,
            'parent_id' => $data['parent_id'],
        ]);

        $category->addTranslations($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
