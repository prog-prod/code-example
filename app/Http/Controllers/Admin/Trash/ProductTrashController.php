<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class ProductTrashController extends Controller
{
    public function index()
    {
        $deletedProducts = Product::onlyTrashed()->paginate(10);

        return view('admin.trash.products', compact('deletedProducts'));
    }

    public function restore(Product $product)
    {
        $product->restore();
        return redirect()->route('admin.trash.products.index')->with('success', 'Product has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->forceDelete();

        return redirect()->route('admin.trash.products.index')->with(['success' => 'Product has been destroyed.']);
    }

    public function destroyAll()
    {
        $deletedProducts = Product::onlyTrashed()->get();

        $deletedProducts->each(function (Product $item) {
            $item->forceDelete();
        });

        return redirect()->route('admin.trash.products.index')->with(['success' => 'Products has been destroyed.']);
    }
}
