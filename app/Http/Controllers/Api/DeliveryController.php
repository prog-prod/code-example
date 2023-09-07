<?php

namespace App\Http\Controllers\Api;

use App\Contracts\NovaPoshtaServiceInterface;
use App\Contracts\OrderServiceInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\ProductServiceInterface;
use App\Enums\CurrencyEnum;
use App\Facades\CurrencyFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DeliveryDateRequest;
use App\Http\Requests\Api\SearchCityRequest;
use App\Http\Requests\Api\SearchNovaPoshtaDepartmentRequest;
use App\Http\Requests\Api\SearchStreetRequest;
use App\Http\Requests\CalcDeliveryCostRequest;
use Brick\Math\Exception\MathException;

class DeliveryController extends Controller
{
    public function searchCity(SearchCityRequest $request, NovaPoshtaServiceInterface $novaPoshtaService)
    {
        $data = $novaPoshtaService->searchSettlements($request->get('city'));

        return collect($data)->toJson();
    }

    public function searchStreet(SearchStreetRequest $request, NovaPoshtaServiceInterface $novaPoshtaService)
    {
        $data = $novaPoshtaService->searchSettlementStreets($request->get('street'), $request->get('cityRef'));

        return collect($data)->toJson();
    }

    public function searchNovaPoshtaCity(SearchCityRequest $request, NovaPoshtaServiceInterface $novaPoshtaService)
    {
        $data = $novaPoshtaService->getCities($request->get('city'));

        return collect($data)->toJson();
    }

    public function searchNovaPoshtaDepartments(
        SearchNovaPoshtaDepartmentRequest $request,
        NovaPoshtaServiceInterface $novaPoshtaService
    ) {
        $data = $novaPoshtaService->getWarehouses($request->get('cityRef'), $request->get('warehouseId'));

        return collect($data)->toJson();
    }

    /**
     * @throws MathException
     */
    public function calcDeliveryCost(
        CalcDeliveryCostRequest $request,
        NovaPoshtaServiceInterface $novaPoshtaService,
        OrderServiceInterface $orderService,
        ProductServiceInterface $productService
    ) {
        $validatedData = $request->validated();
        $productQuantityMap = [];
        $productRepository = app(ProductRepositoryInterface::class);
        $products = collect($validatedData['cartItems'])->map(function ($item) use (&$productQuantityMap) {
            $productQuantityMap[$item['product']] = $item['quantity'];
            return $item['product'];
        })->toArray();
        $products = $productRepository->getProductsById($products);

        $cargoDescription = $novaPoshtaService->getCargoDetails($products, $productQuantityMap);

        $cost = CurrencyFacade::moneyDecorator(
            $orderService->countOrderTotalPrice($products, $productQuantityMap),
            CurrencyEnum::UAH->value
        )->getAmount()->toInt();
        $totalWeight = $productService->getTotalWeight($products);

        return $novaPoshtaService->getDocumentPrice(
            $validatedData['cityRecipient'],
            $cargoDescription,
            $cost,
            $totalWeight
        )->data;
    }

    public function getDeliveryDate(DeliveryDateRequest $request, NovaPoshtaServiceInterface $novaPoshtaService)
    {
        $validatedData = $request->validated();
        $deliveryDate = $novaPoshtaService->getDocumentDeliveryDate($validatedData['cityRecipient']);
        return $deliveryDate->data->first()?->deliveryDate;
    }
}
