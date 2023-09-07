<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\PrintCategory;
use Illuminate\Http\RedirectResponse;

class PrintCategoryTrashController extends Controller
{
    public function index()
    {
        $deletedPrintCategories = PrintCategory::onlyTrashed()->paginate(10);

        return view('admin.trash.print-categories', compact('deletedPrintCategories'));
    }

    public function restore(PrintCategory $printCategory)
    {
        $printCategory->restore();
        return redirect()->route('admin.trash.print-categories.index')->with(
            'success',
            'Print category has been restored.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PrintCategory $printCategory
     * @return RedirectResponse
     */
    public function destroy(PrintCategory $printCategory)
    {
        $printCategory->forceDelete();

        return redirect()->route('admin.trash.print-categories.index')->with(
            ['success' => 'Print category has been destroyed.']
        );
    }
}
