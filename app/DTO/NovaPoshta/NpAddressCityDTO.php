<?php

namespace App\DTO\NovaPoshta;

class NpAddressCityDTO
{
    public string $present;
    public int $warehouses;
    public string $mainDescription;
    public string $area;
    public string $region;
    public string $settlementTypeCode;
    public string $ref;
    public string $deliveryCity;
    public bool $addressDeliveryAllowed;
    public bool $streetsAvailability;
    public string $parentRegionTypes;
    public string $parentRegionCode;
    public string $regionTypes;
    public string $regionTypesCode;


    public function __construct(
        string $present,
        int $warehouses,
        string $mainDescription,
        string $area,
        string $region,
        string $settlementTypeCode,
        string $ref,
        string $deliveryCity,
        bool $addressDeliveryAllowed,
        bool $streetsAvailability,
        string $parentRegionTypes,
        string $parentRegionCode,
        string $regionTypes,
        string $regionTypesCode
    ) {
        $this->present = $present;
        $this->warehouses = $warehouses;
        $this->mainDescription = $mainDescription;
        $this->area = $area;
        $this->region = $region;
        $this->settlementTypeCode = $settlementTypeCode;
        $this->ref = $ref;
        $this->deliveryCity = $deliveryCity;
        $this->addressDeliveryAllowed = $addressDeliveryAllowed;
        $this->streetsAvailability = $streetsAvailability;
        $this->parentRegionTypes = $parentRegionTypes;
        $this->parentRegionCode = $parentRegionCode;
        $this->regionTypes = $regionTypes;
        $this->regionTypesCode = $regionTypesCode;
    }
}
