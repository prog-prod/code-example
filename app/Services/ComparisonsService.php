<?php

namespace App\Services;

use App\Contracts\ComparisonRepositoryInterface;
use App\Contracts\ComparisonsServiceInterface;
use App\Models\Category;
use App\Models\Comparison;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ComparisonsService implements ComparisonsServiceInterface
{
    /**
     * @var User|null
     */
    private ?User $user;

    /**
     * @var ComparisonRepositoryInterface
     */
    private ComparisonRepositoryInterface $comparisonRepository;
    private bool $checkAuth;

    /**
     * ComparisonsService constructor.
     *
     */
    public function __construct()
    {
        $this->user = auth('web')->user();
        $this->comparisonRepository = app(ComparisonRepositoryInterface::class);
        $this->checkAuth = auth('web')->check();
    }

    /**
     * Get the count of items in the comparisons.
     *
     * @return int
     */
    public function getComparisonsItemsCount(): int
    {
        if (!$this->checkAuth) {
            return collect((session("comparisons", [])))->flatten()->count();
        }

        return $this->user->comparisons->count();
    }

    /**
     * Check if the comparisons contain a product.
     *
     * @param Product $product
     * @return bool
     */
    public function contains(Product $product): bool
    {
        if ($this->checkAuth) {
            return $this->user->comparisons->contains($product->id);
        }

        return session()->has("comparisons.{$product->category_id}.{$product->id}");
    }

    /**
     * Get the comparisons for a specific category.
     *
     * @param Category $category
     * @return LengthAwarePaginator
     */
    public function getComparisons(Category $category): LengthAwarePaginator
    {
        if ($this->checkAuth) {
            return $this->user->comparisons()->whereBelongsTo($category)->paginate(9);
        }

        $products = array_keys(session("comparisons.{$category->id}", []));
        return Product::globalWith()->whereIn('id', $products)->paginate(9);
    }

    /**
     * Add a product to the comparisons.
     *
     * @param Product $product
     * @return void
     */
    public function addComparison(Product $product): void
    {
        if ($this->checkAuth) {
            $this->comparisonRepository->createComparison([
                'user_id' => $this->user->id,
                'product_id' => $product->id,
                'category_id' => $product->category_id,
            ]);
        } else {
            session()->put("comparisons.{$product->category_id}.{$product->id}", $product->id);
        }
    }

    /**
     * Delete a product from the comparisons.
     *
     * @param Product $product
     * @return void
     */
    public function deleteComparison(Product $product): void
    {
        if ($this->checkAuth) {
            Comparison::where('user_id', $this->user->id)
                ->where('product_id', $product->id)
                ->delete();
        } else {
            session()->remove("comparisons.{$product->category_id}.$product->id");

            if (count(session("comparisons.{$product->category_id}")) === 0) {
                session()->remove("comparisons.{$product->category_id}");
            }
        }
    }

    /**
     * Get the categories of the comparisons.
     *
     * @return Collection
     */
    public function getCategories(): Collection
    {
        if ($this->checkAuth) {
            return $this->comparisonRepository->getCategories($this->user);
        }

        $categories = array_keys(session('comparisons', []));
        return Category::whereIn('id', $categories)->get();
    }
}
