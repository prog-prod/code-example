<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;

class CategoryTrashController extends Controller
{
    public function index()
    {
        $deletedCategories = Category::onlyTrashed()->paginate(10);

        return view('admin.trash.categories', compact('deletedCategories'));
    }

    public function restore(Category $category)
    {
        $category->restore();
        return redirect()->route('admin.trash.categories.index')->with('success', 'Category has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->forceDelete();
        return redirect()->route('admin.trash.categories.index')->with(['success' => 'Category has been destroyed.']);
    }
}
