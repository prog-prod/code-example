<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewTrashController extends Controller
{
    public function index()
    {
        $deletedReviews = Review::onlyTrashed()->paginate(10);

        return view('admin.trash.reviews', compact('deletedReviews'));
    }

    public function restore(Review $review)
    {
        $review->restore();
        return redirect()->route('admin.trash.reviews.index')->with(
            'success',
            'Review has been restored.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     * @return RedirectResponse
     */
    public function destroy(Review $review)
    {
        $review->forceDelete();

        return redirect()->route('admin.trash.reviews.index')->with(
            ['success' => 'Review has been destroyed.']
        );
    }
}
