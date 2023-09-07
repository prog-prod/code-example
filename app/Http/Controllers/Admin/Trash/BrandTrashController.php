<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;

class BrandTrashController extends Controller
{
    public function index()
    {
        $deletedBrands = Brand::onlyTrashed()->paginate(10);

        return view('admin.trash.brands', compact('deletedBrands'));
    }

    public function restore(Brand $brand)
    {
        $brand->restore();
        return redirect()->route('admin.trash.brands.index')->with('success', 'Brand has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        $brand->forceDelete();

        return redirect()->route('admin.trash.brands.index')->with(['success' => 'Brand has been destroyed.']);
    }
}
