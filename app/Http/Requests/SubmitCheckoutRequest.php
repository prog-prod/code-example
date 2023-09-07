<?php

namespace App\Http\Requests;

use App\Contracts\DeliveryServiceInterface;
use App\Contracts\PaymentServiceInterface;
use App\Enums\DeliveryEnum;
use App\Facades\PhoneConfirmationFacade;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubmitCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(
        Request $request,
        PaymentServiceInterface $paymentService,
        DeliveryServiceInterface $deliveryService
    ): array {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|size:' . PhoneConfirmationFacade::getMaxFormattedCharactersLength(),
            'email' => 'required|email',
            'paymentMethod' => 'required|in:' . $paymentService->getMethodsString(),
            'deliveryMethod' => 'required|in:' . $deliveryService->getMethodsString(),
            'call_me_back' => 'required|boolean',
            'deliveryDepartment' => [
                'nullable',
                'array',
                Rule::requiredIf(function () use ($request) {
                    return $request->input('deliveryMethod') === DeliveryEnum::NOVAPOSHTA_DEPARTMENT->value;
                }),
            ],
            'deliveryDepartment.beaconCode' => 'nullable',
            'deliveryDepartment.bicycleParking' => 'nullable|string',
            'deliveryDepartment.canGetMoneyTransfer' => 'nullable|string',
            'deliveryDepartment.categoryOfWarehouse' => 'nullable|string',
            'deliveryDepartment.cityDescription' => 'nullable|string',
            'deliveryDepartment.cityDescriptionRu' => 'nullable|string',
            'deliveryDepartment.cityRef' => 'string',
            'deliveryDepartment.delivery' => 'nullable|array',
            'deliveryDepartment.delivery.monday' => 'nullable|string',
            'deliveryDepartment.delivery.tuesday' => 'nullable|string',
            'deliveryDepartment.delivery.wednesday' => 'nullable|string',
            'deliveryDepartment.delivery.thursday' => 'nullable|string',
            'deliveryDepartment.delivery.friday' => 'nullable|string',
            'deliveryDepartment.delivery.saturday' => 'nullable|string',
            'deliveryDepartment.delivery.sunday' => 'nullable|string',
            'deliveryDepartment.denyToSelect' => 'nullable|string',
            'deliveryDepartment.description' => 'nullable|string',
            'deliveryDepartment.descriptionRu' => 'nullable|string',
            'deliveryDepartment.direct' => 'nullable',
            'deliveryDepartment.districtCode' => 'nullable|string',
            'deliveryDepartment.generatorEnabled' => 'nullable|string',
            'deliveryDepartment.internationalShipping' => 'nullable|string',
            'deliveryDepartment.latitude' => 'nullable|string',
            'deliveryDepartment.longitude' => 'nullable|string',
            'deliveryDepartment.maxDeclaredCost' => 'nullable|string',
            'deliveryDepartment.number' => 'nullable|string',
            'deliveryDepartment.onlyReceivingParcel' => 'nullable|string',
            'deliveryDepartment.POSTerminal' => 'nullable|string',
            'deliveryDepartment.paymentAccess' => 'nullable|string',
            'deliveryDepartment.phone' => 'nullable|string',
            'deliveryDepartment.placeMaxWeightAllowed' => 'nullable|string',
            'deliveryDepartment.postFinance' => 'nullable|string',
            'deliveryDepartment.postMachineType' => 'nullable',
            'deliveryDepartment.postalCodeUA' => 'nullable',
            'deliveryDepartment.receivingLimitationsOnDimensions' => 'nullable|array',
            'deliveryDepartment.receivingLimitationsOnDimensions.height' => 'nullable|integer',
            'deliveryDepartment.receivingLimitationsOnDimensions.length' => 'nullable|integer',
            'deliveryDepartment.receivingLimitationsOnDimensions.width' => 'nullable|integer',
            'deliveryDepartment.reception' => 'nullable|array',
            'deliveryDepartment.reception.monday' => 'nullable|string',
            'deliveryDepartment.reception.tuesday' => 'nullable|string',
            'deliveryDepartment.reception.wednesday' => 'nullable|string',
            'deliveryDepartment.reception.thursday' => 'nullable|string',
            'deliveryDepartment.reception.friday' => 'nullable|string',
            'deliveryDepartment.reception.saturday' => 'nullable|string',
            'deliveryDepartment.reception.sunday' => 'nullable|string',
            'deliveryDepartment.ref' => 'string',
            'deliveryDepartment.regionCity' => 'string',
            'deliveryDepartment.schedule' => 'nullable|array',
            'deliveryDepartment.schedule.monday' => 'nullable|string',
            'deliveryDepartment.schedule.tuesday' => 'nullable|string',
            'deliveryDepartment.schedule.wednesday' => 'nullable|string',
            'deliveryDepartment.schedule.thursday' => 'nullable|string',
            'deliveryDepartment.schedule.friday' => 'nullable|string',
            'deliveryDepartment.schedule.saturday' => 'nullable|string',
            'deliveryDepartment.schedule.sunday' => 'nullable|string',
            'deliveryDepartment.selfServiceWorkplacesCount' => 'nullable|string',
            'deliveryDepartment.sendingLimitationsOnDimensions' => 'nullable|array',
            'deliveryDepartment.sendingLimitationsOnDimensions.height' => 'nullable|integer',
            'deliveryDepartment.sendingLimitationsOnDimensions.length' => 'nullable|integer',
            'deliveryDepartment.sendingLimitationsOnDimensions.width' => 'nullable|integer',
            'deliveryDepartment.settlementAreaDescription' => 'nullable|string',
            'deliveryDepartment.settlementDescription' => 'nullable|string',
            'deliveryDepartment.settlementRef' => 'nullable|string',
            'deliveryDepartment.settlementRegionsDescription' => 'nullable|string',
            'deliveryDepartment.settlementTypeDescription' => 'nullable|string',
            'deliveryDepartment.settlementTypeDescriptionRu' => 'nullable|string',
            'deliveryDepartment.shortAddress' => 'nullable|string',
            'deliveryDepartment.shortAddressRu' => 'nullable|string',
            'deliveryDepartment.siteKey' => 'nullable|string',
            'deliveryDepartment.totalMaxWeightAllowed' => 'nullable|string',
            'deliveryDepartment.typeOfWarehouse' => 'nullable|string',
            'deliveryDepartment.warehouseForAgent' => 'nullable|string',
            'deliveryDepartment.warehouseIllusha' => 'nullable|string',
            'deliveryDepartment.warehouseIndex' => 'nullable|string',
            'deliveryDepartment.warehouseStatus' => 'nullable|string',
            'deliveryDepartment.warehouseStatusDate' => 'nullable|string',
            'deliveryDepartment.workInMobileAwis' => 'nullable|string',
            'deliveryDepartmentCity' => [
                'nullable',
                'array',
                Rule::requiredIf(function () use ($request) {
                    return $request->input('deliveryMethod') === DeliveryEnum::NOVAPOSHTA_DEPARTMENT->value;
                }),
            ],
            'deliveryDepartmentCity.description' => 'string',
            'deliveryDepartmentCity.descriptionRu' => 'string',
            'deliveryDepartmentCity.ref' => 'string',
            'deliveryDepartmentCity.delivery1' => 'nullable|string',
            'deliveryDepartmentCity.delivery2' => 'nullable|string',
            'deliveryDepartmentCity.delivery3' => 'nullable|string',
            'deliveryDepartmentCity.delivery4' => 'nullable|string',
            'deliveryDepartmentCity.delivery5' => 'nullable|string',
            'deliveryDepartmentCity.delivery6' => 'nullable|string',
            'deliveryDepartmentCity.delivery7' => 'nullable|string',
            'deliveryDepartmentCity.area' => 'nullable|string',
            'deliveryDepartmentCity.settlementType' => 'nullable|string',
            'deliveryDepartmentCity.isBranch' => 'nullable|string',
            'deliveryDepartmentCity.preventEntryNewStreetsUser' => 'nullable|string',
            'deliveryDepartmentCity.specialCashCheck' => 'nullable|numeric',
            'deliveryDepartmentCity.areaDescription' => 'nullable|string',
            'deliveryDepartmentCity.areaDescriptionRu' => 'nullable|string',
            'deliveryDepartmentCity.cityID' => 'nullable|string',
            'deliveryDepartmentCity.settlementTypeDescriptionRu' => 'nullable|string',
            'deliveryDepartmentCity.settlementTypeDescription' => 'nullable|string',
            'confirm_phone_code' => 'nullable|string|size:' . PhoneConfirmationFacade::getPhoneCodeFormattedLength(),
            'city' => [
                'nullable',
                'array',
                Rule::requiredIf(function () use ($request) {
                    return $request->input('deliveryMethod') === DeliveryEnum::NOVAPOSHTA_COURIER->value;
                })
            ],
            'city.ref' => 'nullable|string',
            'city.area' => 'nullable|string',
            'city.region' => 'nullable|string',
            'city.present' => 'string',
            'city.warehouses' => 'nullable|integer',
            'city.regionTypes' => 'nullable|string',
            'city.deliveryCity' => 'nullable|string',
            'city.mainDescription' => 'nullable|string',
            'city.regionTypesCode' => 'nullable|string',
            'city.parentRegionCode' => 'nullable|string',
            'city.parentRegionTypes' => 'nullable|string',
            'city.settlementTypeCode' => 'nullable|string',
            'city.streetsAvailability' => 'nullable|bool',
            'city.addressDeliveryAllowed' => 'nullable|bool',
            'street' => [
                'nullable',
                'array',
                Rule::requiredIf(function () use ($request) {
                    return $request->input('deliveryMethod') === DeliveryEnum::NOVAPOSHTA_COURIER->value;
                }),
            ],
            'street.present' => 'nullable|string',
            'street.location' => 'nullable|array',
            'street.location.lat' => 'nullable|integer',
            'street.location.lon' => 'nullable|integer',
            'street.streetsType' => 'nullable|string',
            'street.settlementRef' => 'nullable|string',
            'street.settlementStreetRef' => 'nullable|string',
            'street.streetsTypeDescription' => 'nullable|string',
            'street.settlementStreetDescription' => 'nullable|string',
            'street.settlementStreetDescriptionRu' => 'nullable|string',
            'flat' => 'nullable|string',
            'house' => [
                'nullable',
                'string',
                Rule::requiredIf(function () use ($request) {
                    return $request->input('deliveryMethod') === DeliveryEnum::NOVAPOSHTA_COURIER->value;
                }),
            ],

        ];
    }
}
