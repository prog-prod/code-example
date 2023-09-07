<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProductRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index()
    {
        $reviews = Review::with(['product', 'user'])->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create(ProductRepositoryInterface $productRepository, UserRepositoryInterface $userRepository)
    {
        $products = $productRepository->getAllProducts();
        $users = $userRepository->getAllUsers();
        return view('admin.reviews.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $review = Review::create($validated);
        return redirect()->route('admin.reviews.show', $review->id)->with('success', 'Review created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Review $review
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show(Review $review)
    {
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Review $review
     * @param ProductRepositoryInterface $productRepository
     * @param UserRepositoryInterface $userRepository
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(
        Review $review,
        ProductRepositoryInterface $productRepository,
        UserRepositoryInterface $userRepository
    ) {
        $products = $productRepository->getAllProducts();
        $users = $userRepository->getAllUsers();
        return view('admin.reviews.edit', compact('review', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Review $review
     * @return RedirectResponse
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $review->update($validated);
        return redirect()->route('admin.reviews.show', $review->id)->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     * @return RedirectResponse
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }
}
