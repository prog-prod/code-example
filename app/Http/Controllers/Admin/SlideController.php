<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideRequest;
use App\Models\Slide;
use App\Models\Slider;
use App\Services\HeroSliderService;
use Illuminate\Http\Request;

class SlideController extends BaseAdminController
{

    public function create(Request $request, Slider $slider, HeroSliderService $heroSliderService)
    {
        $sliders = Slider::all();
        return view('admin.slides.create', compact('slider', 'sliders'));
    }

    public function store(SlideRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();
        $data = [
            'slider_id' => $validatedData['slider_id'] ?? null,
            'order' => $validatedData['order'] ?? 1,
            'link_url' => $validatedData['link_url'] ?? null,
        ];
        if (isset($validatedData['image_jpg'])) {
            $data['image_jpg'] = $validatedData['image_jpg']->store('public/slides');
        }
        if (isset($validatedData['image_webp_mobile'])) {
            $data['image_webp_mobile'] = $validatedData['image_webp_mobile']->store('public/slides');
        }
        if (isset($validatedData['image_jpg_mobile'])) {
            $data['image_jpg_mobile'] = $validatedData['image_jpg_mobile']->store('public/slides');
        }
        if (isset($validatedData['image_webp_desktop'])) {
            $data['image_webp_desktop'] = $validatedData['image_webp_desktop']->store('public/slides');
        }
        if (isset($validatedData['image_jpg_desktop'])) {
            $data['image_jpg_desktop'] = $validatedData['image_jpg_desktop']->store('public/slides');
        }

        $slide = Slide::create($data);
        $slide->addTranslations($validatedData, 'slide');

        return redirect()->route('admin.slides.show', $slide)->with('success', 'Slide created successfully.');
    }

    public function edit(Slide $slide, HeroSliderService $heroSliderService)
    {
        $sliders = Slider::all();
        return view('admin.slides.edit', compact('slide', 'sliders'));
    }

    public function update(SlideRequest $request, Slide $slide)
    {
        $validatedData = $request->validated();

        $data = [
            'slider_id' => $validatedData['slider_id'],
            'order' => $validatedData['order'] ?? 1,
            'link_url' => $validatedData['link_url'] ?? null,
        ];
        if (isset($validatedData['image_jpg'])) {
            $data['image_jpg'] = $validatedData['image_jpg']->store('public/slides');
        }
        if (isset($validatedData['image_webp_mobile'])) {
            $data['image_webp_mobile'] = $validatedData['image_webp_mobile']->store('public/slides');
        }
        if (isset($validatedData['image_jpg_mobile'])) {
            $data['image_jpg_mobile'] = $validatedData['image_jpg_mobile']->store('public/slides');
        }
        if (isset($validatedData['image_webp_desktop'])) {
            $data['image_webp_desktop'] = $validatedData['image_webp_desktop']->store('public/slides');
        }
        if (isset($validatedData['image_jpg_desktop'])) {
            $data['image_jpg_desktop'] = $validatedData['image_jpg_desktop']->store('public/slides');
        }

        $slide->update($data);
        $slide->addTranslations($validatedData, 'slide');

        return redirect()->route('admin.sliders.show', $slide->slider)->with(
            'success',
            'Slide updated successfully.'
        );
    }

    public function show(Slide $slide)
    {
        return view('admin.slides.show', compact('slide'));
    }

    public function destroy(Slide $slide, Request $request)
    {
        $slide->delete();

        if ($request->has('slider')) {
            return redirect()->route('admin.sliders.show', $request->get('slider'))->with(
                'success',
                'Slide deleted successfully.'
            );
        }
        return redirect()->route('admin.sliders.index')->with('success', 'Slide deleted successfully.');
    }
}
