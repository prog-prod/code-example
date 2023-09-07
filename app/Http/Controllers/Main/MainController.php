<?php

namespace App\Http\Controllers\Main;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\PageRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Http\Controllers\BaseController;
use App\Http\Requests\NewsletterSubscriptionRequest;
use App\Http\Requests\ValidatePhoneRequest;
use App\Http\Requests\VerifyPhoneRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\ProductResource;
use App\Models\Subscriber;
use App\Services\HeroSliderService;
use App\Services\PhoneConfirmationService;

class MainController extends BaseController
{
    /**
     * Display a main page.
     */
    public function index(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        PageRepositoryInterface $pageRepository,
        HeroSliderService $sliderService
    ) {
//        $productDeal = $productRepository->getProductForBestDeal();
        $pageSettings = $pageRepository->getHomePage();
        return $this->showView('Main', [
            'heroSlider' => $sliderService->getMainSlider(),
            'collectionProducts' => ProductResource::collection(
                $productRepository->getProductCollection()
            ),
            'productDeal' => null,
            'page' => $pageSettings ? new PageResource($pageSettings) : null,
            'categories' => CategoryResource::collection($categoryRepository->getHierarchyCategories())->jsonSerialize(
            ),
        ]);
    }


    public function storeSubscriber(NewsletterSubscriptionRequest $request)
    {
        $subscriber = Subscriber::create([
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Subscriber added successfully!');
    }

    public function verifyPhone(
        VerifyPhoneRequest $request,
        PhoneConfirmationService $phoneConfirmationService,
        UserServiceInterface $userService
    ) {
        $user = $request->user();
        $data = $request->validated();
        $verifiedPhone = $phoneConfirmationService->checkCode($data['phone'], $data['code']);
        if ($user && $verifiedPhone && $userService->isMyPhoneNumber($data['phone'])) {
            $user->verifyPhone();
        }
        if ($verifiedPhone) {
            $phoneConfirmationService->cacheVerifiedPhone($data['phone']);
        }

        return back()->with('isVerifiedPhone', $verifiedPhone);
    }

    public function sendCode(
        ValidatePhoneRequest $request,
        PhoneConfirmationService $phoneConfirmationService
    ) {
        $data = $request->validated();
        $code = $phoneConfirmationService->generateCode();
        $phoneConfirmationService->sendConfirmationCode($data['phone'], $code);
    }
}
