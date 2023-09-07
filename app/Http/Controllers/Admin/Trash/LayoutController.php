<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Contracts\LayoutRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Layout;
use Illuminate\Http\RedirectResponse;

class LayoutController extends Controller
{
    public function index(LayoutRepositoryInterface $layoutRepository)
    {
        $deletedLayouts = $layoutRepository->getTrashedLayouts();
        return view('admin.trash.layouts', compact('deletedLayouts'));
    }

    public function restore(Layout $layout)
    {
        $layout->restore();
        return redirect()->route('admin.trash.layouts.index')->with(
            'success',
            'Layout has been restored.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Layout $layout
     * @return RedirectResponse
     */
    public function destroy(Layout $layout)
    {
        $layout->forceDelete();

        return redirect()->route('admin.trash.layouts.index')->with(
            ['success' => 'Layout has been destroyed.']
        );
    }
}
