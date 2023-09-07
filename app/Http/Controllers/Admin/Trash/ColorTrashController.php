<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;

class ColorTrashController extends Controller
{
    public function index()
    {
        $deletedColors = Color::onlyTrashed()->paginate(10);

        return view('admin.trash.colors', compact('deletedColors'));
    }

    public function restore(Color $color)
    {
        $color->restore();
        return redirect()->route('admin.trash.colors.index')->with('success', 'Color has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color
     * @return RedirectResponse
     */
    public function destroy(Color $color)
    {
        $color->forceDelete();

        return redirect()->route('admin.trash.colors.index')->with(['success' => 'Color has been destroyed.']);
    }

}
