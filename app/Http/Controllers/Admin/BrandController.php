<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class BrandController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index()
    {
        $brands = Brand::with('products')->get();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandRequest $request
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     */
    public function store(BrandRequest $request)
    {
        $data = $request->validated();

        $brand = Brand::create([
            'key' => $data['key'],
        ]);
        $brand->addTranslations($data);

        return redirect(route('admin.brands.index'))->with('success', 'Brand created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show(Brand $brand)
    {
        $brand->load('products');
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BrandRequest $request
     * @param Brand $brand
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $data = $request->validated();
        $brand->update([
            'key' => $data['key'],
        ]);
        $brand->addTranslations($data);

        return redirect(route('admin.brands.index'))->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect(route('admin.brands.index'))->with('success', 'Brand deleted successfully!');
    }
}
