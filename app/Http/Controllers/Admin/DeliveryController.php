<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliveryRequest;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();

        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        return view('admin.deliveries.create');
    }

    public function store(DeliveryRequest $request)
    {
        $validatedData = $request->validated();

        $delivery = new Delivery();
        $delivery->key = $validatedData['key'];
        $delivery->params = $validatedData['params'];
        $delivery->save();

        $delivery->addTranslations($validatedData);

        return redirect()->route('admin.deliveries.index')
            ->with('success', 'Delivery created successfully.');
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.deliveries.edit', compact('delivery'));
    }

    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        $validatedData = $request->validated();

        $delivery->key = $validatedData['key'];
        $delivery->params = $validatedData['params'];
        $delivery->save();

        $delivery->addTranslations($validatedData);

        return redirect()->route('admin.deliveries.index')
            ->with('success', 'Delivery method updated successfully.');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return redirect()->route('admin.deliveries.index')
            ->with('success', 'Delivery method deleted successfully.');
    }
}
