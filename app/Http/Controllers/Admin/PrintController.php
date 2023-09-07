<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PrintRequest;
use App\Models\PrintCategory;
use App\Models\PrintImage;
use Storage;

class PrintController extends BaseAdminController
{
    public function index()
    {
        $prints = PrintImage::with('category')->latest()->paginate(10);
        return view('admin.prints.index', compact('prints'));
    }

    public function create()
    {
        $categories = PrintCategory::all();
        return view('admin.prints.create', compact('categories'));
    }

    public function store(PrintRequest $request)
    {
        $validated = $request->validated();


        $image = isset($validated['image']) ? $validated['image']->store('public/prints') : null;

        $print = PrintImage::create([
            'key' => $validated['key'],
            'print_category_id' => $validated['print_category_id'],
            'image' => $image,
        ]);
        $print->addTranslations($validated);

        return redirect()->route('admin.prints.show', $print)->with('success', 'Print created successfully.');
    }

    public function show(PrintImage $print)
    {
        $print->load('category');
        return view('admin.prints.show', compact('print'));
    }

    public function edit(PrintImage $print)
    {
        $categories = PrintCategory::all();
        return view('admin.prints.edit', compact('print', 'categories'));
    }

    public function update(PrintRequest $request, PrintImage $print)
    {
        $validated = $request->validated();

        $print->key = $validated['key'];
        $print->print_category_id = $validated['print_category_id'];

        if ($request->hasFile('image')) {
            if ($print->image && Storage::exists($print->image)) {
                Storage::delete($print->image);
            }
            $imagePath = $request->file('image')->store('public/prints');
            $print->image = $imagePath;
        }

        $print->save();
        $print->addTranslations($validated);

        return redirect()->route('admin.prints.show', $print)->with('success', 'Print updated successfully.');
    }

    public function destroy(PrintImage $print)
    {
        if ($print->image) {
            Storage::delete($print->image); // Remove image file from storage
        }
        $print->delete();

        return redirect()->route('admin.prints.index')->with('success', 'Print deleted successfully.');
    }
}
