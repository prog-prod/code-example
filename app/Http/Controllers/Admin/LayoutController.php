<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\LayoutRepositoryInterface;
use App\Enums\LayoutEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LayoutRequest;
use App\Models\Layout;
use Storage;

class LayoutController extends BaseAdminController
{
    public function index(LayoutRepositoryInterface $layoutRepository)
    {
        $layouts = $layoutRepository->getAll();

        return view('admin.pages-layouts.index', compact('layouts'));
    }

    public function create()
    {
        return view('admin.pages-layouts.create');
    }

    public function store(LayoutRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'key' => $validated['key'],
            'top_ads_status' => $validated['top_ads_status'] ?? 0,
            'top_ads_link' => $validated['top_ads_link'] ?? null,
            'top_ads_bg_color' => $validated['top_ads_bg_color'] ?? null,
            'phones' => $validated['phones'] ?? null,
            'emails' => $validated['emails'] ?? null,
        ];

        if (isset($validated['header_logo'])) {
            $data['header_logo'] = $validated['header_logo']->store('public/images');
        }
        if (isset($validated['footer_logo'])) {
            $data['footer_logo'] = $validated['footer_logo']->store('public/images');
        }
        if (isset($validated['top_ads_image'])) {
            $data['top_ads_image'] = $validated['top_ads_image']->store('public/images');
        }

        $layout = Layout::create($data);
        $layout->addTranslations($validated, 'layout');

        return redirect()->route('admin.layouts.index')
            ->with('success', 'Layout was successfully created.');
    }

    public function edit(Layout $layout)
    {
        return view('admin.pages-layouts.edit', compact('layout'));
    }

    public function update(LayoutRequest $request, Layout $layout)
    {
        $validated = $request->validated();

        $data = [
            'key' => $validated['key'],
            'top_ads_status' => $validated['top_ads_status'] ?? 0,
            'top_ads_link' => $validated['top_ads_link'] ?? null,
            'top_ads_bg_color' => $validated['top_ads_bg_color'] ?? null,
            'phones' => $validated['phones'] ?? null,
            'emails' => $validated['emails'] ?? null,
        ];

        if (isset($validated['header_logo'])) {
            if ($layout->header_logo && Storage::exists($layout->header_logo)) {
                Storage::delete($layout->header_logo);
            }
            $data['header_logo'] = $validated['header_logo']->store('public/images');
        }
        if (isset($validated['footer_logo'])) {
            if ($layout->footer_logo && Storage::exists($layout->footer_logo)) {
                Storage::delete($layout->footer_logo);
            }
            $data['footer_logo'] = $validated['footer_logo']->store('public/images');
        }
        if (isset($validated['top_ads_image'])) {
            if ($layout->top_ads_image && Storage::exists($layout->top_ads_image)) {
                Storage::delete($layout->top_ads_image);
            }
            $data['top_ads_image'] = $validated['top_ads_image']->store('public/images');
        }

        $layout->update($data);
        $layout->addTranslations($validated, 'layout');

        return redirect()->route('admin.layouts.index')
            ->with('success', 'Layout was successfully updated.');
    }

    public function destroy(Layout $layout)
    {
        if ($layout->key !== LayoutEnum::MAIN->value) {
            $layout->delete();
        }

        return redirect()->route('admin.layouts.index')
            ->with('success', 'Layout was successfully deleted.');
    }
}
