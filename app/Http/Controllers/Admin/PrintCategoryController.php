<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PrintCategoryRequest;
use App\Models\PrintCategory;
use Storage;

class PrintCategoryController extends BaseAdminController
{
    // Show all print categories
    public function index()
    {
        $printCategories = PrintCategory::all();
        return view('admin.print-categories.index', compact('printCategories'));
    }

    // Show the form for creating a new print category
    public function create()
    {
        $printCategories = PrintCategory::all();
        return view('admin.print-categories.create', compact('printCategories'));
    }

    // Store a newly created print category in the database
    public function store(PrintCategoryRequest $request)
    {
        $validated = $request->validated();
        $printCategory = new PrintCategory();
        $printCategory->key = $validated['key'];
        $printCategory->parent_id = $validated['parent_id'] > 0 ? $request->input('parent_id') : null;

        if ($request->hasFile('image')) {
            $printCategory->image = $validated['image']->store('public/prints/categories');
        }

        $printCategory->save();
        $printCategory->addTranslations($validated);

        return redirect()->route('admin.print-categories.index')->with(
            'success',
            'Print category created successfully.'
        );
    }

    // Show the form for showing an existing print category
    public function show(PrintCategory $printCategory)
    {
        $printCategory->load(['children']);
        return view('admin.print-categories.show', compact('printCategory'));
    }

    // Show the form for editing an existing print category
    public function edit(PrintCategory $printCategory)
    {
        $printCategories = PrintCategory::all();
        return view('admin.print-categories.edit', compact('printCategory', 'printCategories'));
    }

    // Update the specified print category in the database
    public function update(PrintCategoryRequest $request, PrintCategory $printCategory)
    {
        $validated = $request->validated();

        $printCategory->key = $validated['key'];
        $printCategory->parent_id = $validated['parent_id'] > 0 ? $request->input('parent_id') : null;

        if ($request->hasFile('image')) {
            if ($printCategory->image && Storage::exists($printCategory->image)) {
                Storage::delete($printCategory->image);
            }
            $printCategory->image = $validated['image']->store('public/prints/categories');
        }

        $printCategory->save();
        $printCategory->addTranslations($validated);

        return redirect()->route('admin.print-categories.index')->with(
            'success',
            'Print category updated successfully.'
        );
    }

    // Delete the specified print category from the database
    public function destroy(PrintCategory $printCategory)
    {
        if ($printCategory->image) {
            Storage::delete($printCategory->image);
        }

        $printCategory->delete();

        return redirect()->route('admin.print-categories.index')->with(
            'success',
            'Print category deleted successfully.'
        );
    }
}
