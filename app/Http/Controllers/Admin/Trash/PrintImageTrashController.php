<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\PrintImage;
use Illuminate\Http\RedirectResponse;

class PrintImageTrashController extends Controller
{
    public function index()
    {
        $deletedPrints = PrintImage::onlyTrashed()->paginate(10);

        return view('admin.trash.prints', compact('deletedPrints'));
    }

    public function restore(PrintImage $printImage)
    {
        $printImage->restore();
        return redirect()->route('admin.trash.prints.index')->with('success', 'Print has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PrintImage $printImage
     * @return RedirectResponse
     */
    public function destroy(PrintImage $printImage)
    {
        $printImage->forceDelete();

        return redirect()->route('admin.trash.prints.index')->with(['success' => 'Print image has been destroyed.']);
    }
}
