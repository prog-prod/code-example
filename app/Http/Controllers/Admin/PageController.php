<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\LayoutRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Enums\Admin\PageSectionEnum;
use App\Enums\Admin\PageSlugEnum;
use App\Http\Requests\AboutPageRequest;
use App\Http\Requests\Admin\PageRequest;
use App\Http\Requests\ContactPageRequest;
use App\Http\Requests\HomePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Storage;

class PageController extends BaseAdminController
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create(Page $page, LayoutRepositoryInterface $layoutRepository)
    {
        $layouts = $layoutRepository->getAll();
        return view('admin.pages.create', compact('page', 'layouts'));
    }

    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    public function edit(
        Page $page,
        ProductRepositoryInterface $productRepository,
        LayoutRepositoryInterface $layoutRepository
    ) {
        if (in_array($page->slug, PageSlugEnum::getValues())) {
            $productsWithSale = $productRepository->getProductsWithSale();
            $productsCollections = $productRepository->getBestCollections();
            return view(
                'admin.pages.' . $page->slug . '.edit',
                compact('page', 'productsWithSale', 'productsCollections')
            );
        }
        $layouts = $layoutRepository->getAll();
        return view('admin.pages.edit', compact('page', 'layouts'));
    }

    public function store(PageRequest $request)
    {
        $validated = $request->validated();
        if (isset($validated['sections'])) {
            $validated['sections'] = json_decode($validated['sections']);
        }
        $page = Page::create($validated);
        $page->addTranslations($validated, 'pages');

        return redirect()->route('admin.pages.index')->with('success', 'Page was successfully created.');
    }


    public function update(Request $request, Page $page)
    {
        switch ($page->slug) {
            case PageSlugEnum::HOME->value:
                $validated = $request->validate((new HomePageRequest())->rules());
                break;
            case PageSlugEnum::CONTACT->value:
                $validated = $request->validate((new ContactPageRequest())->rules());
                break;
            case PageSlugEnum::ABOUT->value:
                $validated = $request->validate((new AboutPageRequest())->rules());
                break;
            default:
                $validated = $request->validate((new PageRequest())->rules());
        }

        foreach ([PageSectionEnum::ABOUT->value, PageSectionEnum::SALE->value] as $key) {
            if (isset($validated['sections'][$key]['image'])) {
                if (isset($page->sections[$key]['image'])) {
                    Storage::delete($page->sections[$key]['image']);
                }
                $validated['sections'][$key]['image'] = $validated['sections'][$key]['image']->store(
                    'public/pages'
                );
            } else {
                if (isset($page->sections[$key]['image'])) {
                    $validated['sections'][$key]['image'] = $page->sections[$key]['image'];
                }
            }
        }
        if (!in_array($page->slug, PageSlugEnum::getValues())) {
            if (isset($validated['sections'])) {
                $validated['sections'] = json_decode($validated['sections']);
            }
        }

        $page->update([
            'slug' => $validated['slug'],
            'sections' => $validated['sections']
        ]);
        $page->addTranslations($validated, 'pages');

        return redirect()->route('admin.pages.index')->with('success', 'Page was successfully updated.');
    }

    public function destroy(Page $page)
    {
        if (!in_array($page->slug, PageSlugEnum::getValues())) {
            $page->delete();
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page was successfully deleted.');
    }
}
