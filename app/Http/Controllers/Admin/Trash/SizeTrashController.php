<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;

class SizeTrashController extends Controller
{
    public function index()
    {
        $deletedSizes = Size::onlyTrashed()->paginate(10);

        return view('admin.trash.sizes', compact('deletedSizes'));
    }

    public function restore(Size $size)
    {
        $size->restore();
        return redirect()->route('admin.trash.sizes.index')->with('success', 'Size has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Size $size
     * @return RedirectResponse
     */
    public function destroy(Size $size)
    {
        $size->forceDelete();

        return redirect()->route('admin.trash.sizes.index')->with(['success' => 'Size has been destroyed.']);
    }
}
