<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;

class SaleTrashController extends Controller
{
    public function index()
    {
        $deletedSales = Sale::onlyTrashed()->paginate(10);

        return view('admin.trash.sales', compact('deletedSales'));
    }

    public function restore(Sale $sale)
    {
        $sale->restore();
        return redirect()->route('admin.trash.sales.index')->with('success', 'Sale has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sale $sale
     * @return RedirectResponse
     */
    public function destroy(Sale $sale)
    {
        $sale->forceDelete();

        return redirect()->route('admin.trash.sales.index')->with(['success' => 'Sale has been destroyed.']);
    }
}
