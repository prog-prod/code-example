<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorRequest;
use App\Models\Color;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ColorController extends BaseAdminController
{
    public function index()
    {
        $colors = Color::with('products')->get();
        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ColorRequest $request
     * @return RedirectResponse
     */
    public function store(ColorRequest $request)
    {
        $data = $request->validated();
        $color = Color::create([
            "key" => $data['key'],
            "hex_code" => $data['hex_code']
        ]);
        $color->addTranslations($data);

        return redirect()->route('admin.colors.index')->with('success', 'Color created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Color $color
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show(Color $color)
    {
        $color->load('products');
        return view('admin.colors.show', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Color $color
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ColorRequest $request
     * @param Color $color
     * @return RedirectResponse
     */
    public function update(ColorRequest $request, Color $color)
    {
        $data = $request->validated();
        $color->update([
            "key" => $data['key'],
            "hex_code" => $data['hex_code']
        ]);
        $color->addTranslations($data);

        return redirect()->route('admin.colors.index')->with('success', 'Color updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color
     * @return RedirectResponse
     */
    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully.');
    }
}
