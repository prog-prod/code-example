<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;

class SliderController extends BaseAdminController
{
    public function index()
    {
        $sliders = Slider::with('slides')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function show(Slider $slider)
    {
        $slides = $slider->slides()->orderBy('order')->paginate(20);

        return view('admin.sliders.show', compact('slider', 'slides'));
    }

    public function store(SliderRequest $request)
    {
        $validatedData = $request->validated();

        $slider = Slider::create($validatedData);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        $slider->update($validatedData);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }
}
