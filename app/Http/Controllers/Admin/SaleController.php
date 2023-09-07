<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaleRequest;
use App\Models\Sale;

class SaleController extends BaseAdminController
{
    public function index()
    {
        $sales = Sale::with('products')->latest()->paginate(10);

        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function store(SaleRequest $request)
    {
        $data = $request->validated();

        $sale = Sale::create([
            "key" => $data['key'],
            "quantity" => $data['quantity'],
            "percent" => $data['percent'],
            "endDate" => $data['endDate'],
        ]);
        $sale->addTranslations($data);

        return redirect()->route('admin.sales.index')
            ->with('success', 'Sale created successfully.');
    }

    public function show(Sale $sale)
    {
        $sale->load('products');
        return view('admin.sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        return view('admin.sales.edit', compact('sale'));
    }

    public function update(SaleRequest $request, Sale $sale)
    {
        $data = $request->validated();

        $sale->update([
            "key" => $data['key'],
            "quantity" => $data['quantity'],
            "percent" => $data['percent'],
            "endDate" => $data['endDate'],
        ]);
        $sale->addTranslations($data);

        return redirect()->route('admin.sales.index')
            ->with('success', 'Sale updated successfully');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('admin.sales.index')
            ->with('success', 'Sale deleted successfully');
    }
}
