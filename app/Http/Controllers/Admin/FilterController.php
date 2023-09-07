<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\PrintCategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterRequest;
use App\Models\Filter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FilterController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index()
    {
        $filters = Filter::with(['categories', 'printCategories'])->get();
        return view('admin.filters.index', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create(
        CategoryRepositoryInterface $categoryRepository,
        PrintCategoryRepositoryInterface $printCategoryRepository
    ) {
        $categories = $categoryRepository->getAll();
        $printCategories = $printCategoryRepository->getAll();
        return view('admin.filters.create', compact(['categories', 'printCategories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FilterRequest $request
     * @return RedirectResponse
     */
    public function store(FilterRequest $request)
    {
        $validatedData = $request->validated();
        $filter = Filter::create($validatedData);

        $filter->categories()->sync($validatedData['categories'] ?? []);
        $filter->printCategories()->sync($validatedData['printCategories'] ?? []);

        $filter->addTranslations($validatedData);

        return redirect()->route('admin.filters.index')->with('success', 'Filter created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Filter $filter
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show(Filter $filter)
    {
        return view('admin.filters.show', compact('filter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Filter $filter
     * @param CategoryRepositoryInterface $categoryRepository
     * @param PrintCategoryRepositoryInterface $printCategoryRepository
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(
        Filter $filter,
        CategoryRepositoryInterface $categoryRepository,
        PrintCategoryRepositoryInterface $printCategoryRepository
    ) {
        $categories = $categoryRepository->getHierarchyCategories();
        $printCategories = $printCategoryRepository->getHierarchyCategories();
        return view('admin.filters.edit', compact('filter'), compact(['categories', 'printCategories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FilterRequest $request
     * @param Filter $filter
     * @return RedirectResponse
     */
    public function update(FilterRequest $request, Filter $filter)
    {
        $validatedData = $request->validated();

        $filter->categories()->sync($validatedData['categories'] ?? []);
        $filter->printCategories()->sync($validatedData['printCategories'] ?? []);

        $filter->update($validatedData);
        $filter->addTranslations($validatedData);

        return redirect()->route('admin.filters.index')->with('success', 'Filter updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Filter $filter
     * @return RedirectResponse
     */
    public function destroy(Filter $filter)
    {
        $filter->delete();
        return redirect()->route('admin.filters.index')->with('success', 'Filter deleted successfully!');
    }
}
