<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ProductAdminRepositoryInterface;
use App\Enums\CurrencyEnum;
use App\Enums\GenderEnum;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\PrintImage;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductAdminRepositoryInterface $productAdminRepository)
    {
        $products = $productAdminRepository->getAllGroupedProducts();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(
        Request $request,
        CategoryRepositoryInterface $categoryRepository,
        ProductAdminRepositoryInterface $productAdminRepository
    ) {
        $keyGroup = $request->get('group');
        $product = $keyGroup ? $productAdminRepository->getProductsByGroup($keyGroup)->latest()->get()->first() : null;
        $categories = $categoryRepository->getHierarchyCategories();
        $colors = Color::all();
        $sizes = Size::with('category')->get();
        $sales = Sale::all();
        $products = Product::withoutGlobalScope('active')->with('category.parent.parent')->get();
        $relatedProducts = Product::withoutGlobalScope('active')->with('category.parent.parent')->get();
        $genders = GenderEnum::cases();
        $brands = Brand::all();
        $prints = PrintImage::all();
        $currencies = CurrencyEnum::cases();

        return view(
            'admin.products.create',
            compact(
                [
                    'categories',
                    'colors',
                    'prints',
                    'sizes',
                    'sales',
                    'products',
                    'relatedProducts',
                    'genders',
                    'brands',
                    'currencies',
                    'product'
                ]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $validated = $request->validated();
        $product = new Product;
        $this->updateProductFields($validated, $product);
        $product->main = $validated['main'] ?? 0;
        $product->weight = $validated['weight'] ?? 0;
        $product->active = $validated['active'] ?? 0;


        foreach (['color_id', 'size_id', 'brand_id', 'gender_id'] as $column) {
            if (isset($validated[$column]) && $validated[$column] > 0) {
                $product->{$column} = $validated[$column];
            }
        }

        if (isset($validated['new_until'])) {
            $product->new_until = $validated['new_until'];
        }

        $product->save();
        $product->addTranslations($validated);

        if (isset($validated['sale']) && $validated['sale'] > 0) {
            $product->sales()->sync([$validated['sale']], ['quantity' => 1]);
        } else {
            $product->sales()->sync([]);
        }

        $product->related()->sync($validated['related_products'] ?? []);
        $product->prints()->sync($validated['prints'] ?? []);
        $this->saveFeatureText($validated, $product);

        $product->save();

        $this->saveProductImages($validated, $product);

        return redirect()->route('admin.products.group', $product->key)
            ->with('success', 'Product has been created successfully')
            ->withInput($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ProductAdminRepositoryInterface $productAdminRepository)
    {
        $product = $productAdminRepository->getProductById($id);
        $product->load(['productsWithMyQuantity', 'stockProduct']);

        $mainImage = $product->mainImage?->filename;
        $productColors = $product->colors;
        $similarProductsColors = $productAdminRepository->getSimilarProductColors($product);
        $similarProductsSizes = $productAdminRepository->getSimilarProductSizes($product);
        return view(
            'admin.products.show',
            compact('product', 'mainImage', 'productColors', 'similarProductsColors', 'similarProductsSizes')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        string $id,
        CategoryRepositoryInterface $categoryRepository,
        ProductAdminRepositoryInterface $productAdminRepository
    ) {
        $product = $productAdminRepository->getProductByIdFail($id);
        $categories = $categoryRepository->getHierarchyCategories();
        $colors = Color::all();
        $sizes = Size::with('category')->get();
        $sales = Sale::all();
        $relatedProducts = $product->related->pluck('id')->toArray();
        $products = Product::with('category.parent.parent')->get();
        $genders = GenderEnum::cases();
        $brands = Brand::all();
        $currencies = CurrencyEnum::cases();
        $prints = PrintImage::all();
        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories',
                'colors',
                'sizes',
                'sales',
                'products',
                'relatedProducts',
                'genders',
                'brands',
                'currencies',
                'prints'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CreateProductRequest $request,
        string $id,
        ProductAdminRepositoryInterface $productAdminRepository
    ) {
        $product = $productAdminRepository->getProductById($id);
        $validated = $request->validated();
        if (isset($validated['main']) && !!$validated['main']) {
            $productAdminRepository->updateProductGroup($product->key, ['main' => 0], $product);
        }
        $this->updateProductFields($validated, $product);
        $product->new_until = $validated['new_until'] ?? now()->addWeek();
        $product->active = $validated['active'] ?? 0;
        $product->main = $validated['main'] ?? 0;
        $product->weight = $validated['weight'] ?? 0;
        foreach (['color_id', 'size_id', 'brand_id', 'gender_id'] as $column) {
            if (isset($validated[$column]) && $validated[$column] > 0) {
                $product->{$column} = $validated[$column];
            }
        }
        $product->save();
        $product->addTranslations($validated);

        if (isset($validated['sale']) && $validated['sale'] > 0) {
            $product->sales()->sync([$validated['sale']]);
        } else {
            $product->sales()->sync([]);
        }
        $product->related()->sync($validated['related_products'] ?? []);
        $product->prints()->sync($validated['prints'] ?? []);
        $product->features()->delete();

        $this->saveFeatureText($validated, $product);


        if (isset($validated['images'])) {
            $product->images->each(function ($old_image) {
                Storage::disk('public')->delete('images/' . $old_image->filename);
            });
            $product->images()->delete();

            $this->saveProductImages($validated, $product);
        }

        if (isset($validated['images_order'])) {
            $filenames = explode(',', $validated['images_order']);
            foreach ($filenames as $key => $filename) {
                $filteredImg = $product->images->where(
                    'basename',
                    $filename
                )->first();
                if ($filteredImg) {
                    $filteredImg->order = $key + 1;
                    $filteredImg->save();
                }
            }
        }
        if (isset($validated['main-image'])) {
            $img = $product->images->where('basename', $validated['main-image'])->first();
            if ($img) {
                $product->images->each(function ($image) {
                    $image->main = 0;
                    $image->save();
                });
                $img->main = 1;
                $img->save();
            }
        }

        return redirect(route('admin.products.group', $product->key))->withInput($validated)->with(
            'success',
            'Product has been updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        string $id,
        ProductAdminRepositoryInterface $productAdminRepository
    ) {
        $product = $productAdminRepository->getProductByIdFail($id);
        $key = $product->key;
        $product->delete();

        if ($productAdminRepository->countProductsInGroup($key) > 0) {
            return redirect()->route('admin.products.group', $key)->with(
                'success',
                'Product has been deleted successfully'
            );
        }

        return redirect()->route('admin.products.index')->with('success', 'Product has been deleted successfully');
    }

    public function destroyGroup(
        string $key,
        ProductAdminRepositoryInterface $productAdminRepository
    ) {
        $products = $productAdminRepository->getProductsByGroup($key);
        $products->each(function ($item) {
            $item->delete();
        });

        return redirect()->route('admin.products.index')->with(
            'success',
            'Product group ' . $key . ' has been deleted successfully'
        );
    }

    public function group(Request $request, ProductAdminRepositoryInterface $productAdminRepository, $key)
    {
        $products = $productAdminRepository->getProductsByGroup($key)->paginate(30);
        return view('admin.products.group', compact('products', 'key'));
    }

    private function saveFeatureText(array $validated, Product $product)
    {
        foreach ($validated['feature-name_uk'] ?? [] as $index => $name) {
            $feature = $product->features()->create();
            $feature->addTranslations([
                'name_uk' => $validated['feature-name_uk'][$index],
                'text_uk' => $validated['feature-text_uk'][$index],
                'name_en' => $validated['feature-name_en'][$index],
                'text_en' => $validated['feature-text_en'][$index]
            ], 'feature');
        }
    }

    private function saveProductImages(array $validated, Product $product)
    {
        foreach ($validated['images'] ?? [] as $image) {
            $filePath = $image->store('public/images');
            $originalFilename = $image->getClientOriginalName();
            $main = $originalFilename === $validated['main-image'];
            $order = array_search($originalFilename, explode(',', $validated['images_order'])) + 1;

            $product->images()->create([
                'product_id' => $product->id,
                'main' => $main,
                'order' => $order,
                'filename' => $filePath
            ]);
        }
    }

    /**
     * @param mixed $validated
     * @param $product
     * @return void
     */
    private function updateProductFields(mixed $validated, $product): void
    {
        $product->key = $validated['key'];
        $product->slug = $validated['slug'];
        $product->price = $validated['price'] * 100;
        $product->currency_name = $validated['currency'];
        $product->category_id = $validated['category'];
        $product->stock_quantity = $validated['stock_quantity'] ?? 0;
        $product->stock_quantity_product_id = $validated['stock_quantity_product_id'] ?? null;
    }
}
