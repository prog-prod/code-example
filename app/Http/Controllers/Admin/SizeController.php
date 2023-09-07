<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeRequest;
use App\Models\Size;

class SizeController extends BaseAdminController
{
    public function index()
    {
        $sizes = Size::with(['category', 'products'])->get();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create(CategoryRepositoryInterface $categoryRepository)
    {
        $categories = $categoryRepository->getHierarchyCategories();
        return view('admin.sizes.create', compact('categories'));
    }

    public function store(SizeRequest $request)
    {
        $validated = $request->validated();

        if (isset($validated['category_id']) && $validated['category_id'] == 0) {
            $validated['category_id'] = null;
        }

        $size = Size::create([
            "key" => $validated['key'],
            "category_id" => $validated['category_id'],
            "value" => $validated['value'],
        ]);
        $size->addTranslations($validated);

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size created successfully');
    }

    public function show(Size $size)
    {
        $size->load('products');
        return view('admin.sizes.show', compact('size'));
    }

    public function edit(Size $size, CategoryRepositoryInterface $categoryRepository)
    {
        $categories = $categoryRepository->getHierarchyCategories();
        return view('admin.sizes.edit', compact('size', 'categories'));
    }

    public function update(SizeRequest $request, Size $size)
    {
        $validated = $request->validated();

        if (isset($validated['category_id']) && $validated['category_id'] == 0) {
            $validated['category_id'] = null;
        }
        $size->update([
            "key" => $validated['key'],
            "category_id" => $validated['category_id'],
            "value" => $validated['value'],
        ]);
        $size->addTranslations($validated);

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size updated successfully');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size deleted successfully');
    }
}
