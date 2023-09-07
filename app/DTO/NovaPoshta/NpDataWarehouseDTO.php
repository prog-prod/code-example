<?php

namespace App\DTO\NovaPoshta;

class NpDataWarehouseDTO
{

    public ?string $beaconCode;
    public ?string $bicycleParking;
    public ?string $canGetMoneyTransfer;
    public ?string $categoryOfWarehouse;
    public ?string $cityDescription;
    public ?string $cityDescriptionRu;
    public ?string $cityRef;
    public ?NpScheduleDTO $delivery;
    public ?string $denyToSelect;
    public ?string $description;
    public ?string $descriptionRu;
    public ?string $direct;
    public ?string $districtCode;
    public ?string $generatorEnabled;
    public ?string $internationalShipping;
    public ?string $latitude;
    public ?string $longitude;
    public ?string $maxDeclaredCost;
    public ?string $number;
    public ?string $onlyReceivingParcel;
    public ?string $POSTerminal;
    public ?string $paymentAccess;
    public ?string $phone;
    public ?string $placeMaxWeightAllowed;
    public ?string $postFinance;
    public ?string $postMachineType;
    public ?string $postalCodeUA;
    public ?NpSizeMeasurementDTO $receivingLimitationsOnDimensions;
    public ?NpScheduleDTO $reception;
    public ?string $ref;
    public ?string $regionCity;
    public ?NpScheduleDTO $schedule;
    public ?string $selfServiceWorkplacesCount;
    public ?NpSizeMeasurementDTO $sendingLimitationsOnDimensions;
    public ?string $settlementAreaDescription;
    public ?string $settlementDescription;
    public ?string $settlementRef;
    public ?string $settlementRegionsDescription;
    public ?string $settlementTypeDescription;
    public ?string $settlementTypeDescriptionRu;
    public ?string $shortAddress;
    public ?string $shortAddressRu;
    public ?string $siteKey;
    public ?string $totalMaxWeightAllowed;
    public ?string $typeOfWarehouse;
    public ?string $warehouseForAgent;
    public ?string $warehouseIllusha;
    public ?string $warehouseIndex;
    public ?string $warehouseStatus;
    public ?string $warehouseStatusDate;
    public ?string $workInMobileAwis;

    /**
     * @param ?string $beaconCode
     * @param ?string $bicycleParking
     * @param ?string $canGetMoneyTransfer
     * @param ?string $categoryOfWarehouse
     * @param ?string $cityDescription
     * @param ?string $cityDescriptionRu
     * @param ?string $cityRef
     * @param ?NpScheduleDTO $delivery
     * @param ?string $denyToSelect
     * @param ?string $description
     * @param ?string $descriptionRu
     * @param ?string $direct
     * @param ?string $districtCode
     * @param ?string $generatorEnabled
     * @param ?string $internationalShipping
     * @param ?string $latitude
     * @param ?string $longitude
     * @param ?string $maxDeclaredCost
     * @param ?string $number
     * @param ?string $onlyReceivingParcel
     * @param ?string $POSTerminal
     * @param ?string $paymentAccess
     * @param ?string $phone
     * @param ?string $placeMaxWeightAllowed
     * @param ?string $postFinance
     * @param ?string $postMachineType
     * @param ?string $postalCodeUA
     * @param ?NpSizeMeasurementDTO $receivingLimitationsOnDimensions
     * @param ?NpScheduleDTO $reception
     * @param ?string $ref
     * @param ?string $regionCity
     * @param ?NpScheduleDTO $schedule
     * @param ?string $selfServiceWorkplacesCount
     * @param ?NpSizeMeasurementDTO $sendingLimitationsOnDimensions
     * @param ?string $settlementAreaDescription
     * @param ?string $settlementDescription
     * @param ?string $settlementRef
     * @param ?string $settlementRegionsDescription
     * @param ?string $settlementTypeDescription
     * @param ?string $settlementTypeDescriptionRu
     * @param ?string $shortAddress
     * @param ?string $shortAddressRu
     * @param ?string $siteKey
     * @param ?string $totalMaxWeightAllowed
     * @param ?string $typeOfWarehouse
     * @param ?string $warehouseForAgent
     * @param ?string $warehouseIllusha
     * @param ?string $warehouseIndex
     * @param ?string $warehouseStatus
     * @param ?string $warehouseStatusDate
     * @param ?string $workInMobileAwis
     */
    public function __construct(
        ?string $beaconCode,
        ?string $bicycleParking,
        ?string $canGetMoneyTransfer,
        ?string $categoryOfWarehouse,
        ?string $cityDescription,
        ?string $cityDescriptionRu,
        ?string $cityRef,
        ?NpScheduleDTO $delivery,
        ?string $denyToSelect,
        ?string $description,
        ?string $descriptionRu,
        ?string $direct,
        ?string $districtCode,
        ?string $generatorEnabled,
        ?string $internationalShipping,
        ?string $latitude,
        ?string $longitude,
        ?string $maxDeclaredCost,
        ?string $number,
        ?string $onlyReceivingParcel,
        ?string $POSTerminal,
        ?string $paymentAccess,
        ?string $phone,
        ?string $placeMaxWeightAllowed,
        ?string $postFinance,
        ?string $postMachineType,
        ?string $postalCodeUA,
        ?NpSizeMeasurementDTO $receivingLimitationsOnDimensions,
        ?NpScheduleDTO $reception,
        ?string $ref,
        ?string $regionCity,
        ?NpScheduleDTO $schedule,
        ?string $selfServiceWorkplacesCount,
        ?NpSizeMeasurementDTO $sendingLimitationsOnDimensions,
        ?string $settlementAreaDescription,
        ?string $settlementDescription,
        ?string $settlementRef,
        ?string $settlementRegionsDescription,
        ?string $settlementTypeDescription,
        ?string $settlementTypeDescriptionRu,
        ?string $shortAddress,
        ?string $shortAddressRu,
        ?string $siteKey,
        ?string $totalMaxWeightAllowed,
        ?string $typeOfWarehouse,
        ?string $warehouseForAgent,
        ?string $warehouseIllusha,
        ?string $warehouseIndex,
        ?string $warehouseStatus,
        ?string $warehouseStatusDate,
        ?string $workInMobileAwis
    ) {
        $this->beaconCode = $beaconCode;
        $this->bicycleParking = $bicycleParking;
        $this->canGetMoneyTransfer = $canGetMoneyTransfer;
        $this->categoryOfWarehouse = $categoryOfWarehouse;
        $this->cityDescription = $cityDescription;
        $this->cityDescriptionRu = $cityDescriptionRu;
        $this->cityRef = $cityRef;
        $this->delivery = $delivery;
        $this->denyToSelect = $denyToSelect;
        $this->description = $description;
        $this->descriptionRu = $descriptionRu;
        $this->direct = $direct;
        $this->districtCode = $districtCode;
        $this->generatorEnabled = $generatorEnabled;
        $this->internationalShipping = $internationalShipping;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->maxDeclaredCost = $maxDeclaredCost;
        $this->number = $number;
        $this->onlyReceivingParcel = $onlyReceivingParcel;
        $this->POSTerminal = $POSTerminal;
        $this->paymentAccess = $paymentAccess;
        $this->phone = $phone;
        $this->placeMaxWeightAllowed = $placeMaxWeightAllowed;
        $this->postFinance = $postFinance;
        $this->postMachineType = $postMachineType;
        $this->postalCodeUA = $postalCodeUA;
        $this->receivingLimitationsOnDimensions = $receivingLimitationsOnDimensions;
        $this->reception = $reception;
        $this->ref = $ref;
        $this->regionCity = $regionCity;
        $this->schedule = $schedule;
        $this->selfServiceWorkplacesCount = $selfServiceWorkplacesCount;
        $this->sendingLimitationsOnDimensions = $sendingLimitationsOnDimensions;
        $this->settlementAreaDescription = $settlementAreaDescription;
        $this->settlementDescription = $settlementDescription;
        $this->settlementRef = $settlementRef;
        $this->settlementRegionsDescription = $settlementRegionsDescription;
        $this->settlementTypeDescription = $settlementTypeDescription;
        $this->settlementTypeDescriptionRu = $settlementTypeDescriptionRu;
        $this->shortAddress = $shortAddress;
        $this->shortAddressRu = $shortAddressRu;
        $this->siteKey = $siteKey;
        $this->totalMaxWeightAllowed = $totalMaxWeightAllowed;
        $this->typeOfWarehouse = $typeOfWarehouse;
        $this->warehouseForAgent = $warehouseForAgent;
        $this->warehouseIllusha = $warehouseIllusha;
        $this->warehouseIndex = $warehouseIndex;
        $this->warehouseStatus = $warehouseStatus;
        $this->warehouseStatusDate = $warehouseStatusDate;
        $this->workInMobileAwis = $workInMobileAwis;
    }

}
