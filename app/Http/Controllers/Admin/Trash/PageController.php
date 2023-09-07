<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    public function index()
    {
        $deletedPages = Page::onlyTrashed()->paginate(10);

        return view('admin.trash.pages', compact('deletedPages'));
    }

    public function restore(Page $page)
    {
        $page->restore();
        return redirect()->route('admin.trash.pages.index')->with(
            'success',
            'Page has been restored.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return RedirectResponse
     */
    public function destroy(Page $page)
    {
        $page->forceDelete();

        return redirect()->route('admin.trash.pages.index')->with(
            ['success' => 'Page has been destroyed.']
        );
    }
}
