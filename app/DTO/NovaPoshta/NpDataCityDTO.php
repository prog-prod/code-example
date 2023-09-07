<?php

namespace App\DTO\NovaPoshta;

class NpDataCityDTO
{
    /**
     * @var int
     */
    public int $TotalCount;
    /**
     * @var NpAddressCityDTO[]
     */
    public array $Addresses;

    public function __construct(int $TotalCount, array $Addresses)
    {
        $this->TotalCount = $TotalCount;
        $this->Addresses = collect($Addresses)->map(function ($item) {
            return new NpAddressCityDTO(
                present: $item->Present,
                warehouses: $item->Warehouses,
                mainDescription: $item->MainDescription,
                area: $item->Area,
                region: $item->Region,
                settlementTypeCode: $item->SettlementTypeCode,
                ref: $item->Ref,
                deliveryCity: $item->DeliveryCity,
                addressDeliveryAllowed: $item->AddressDeliveryAllowed,
                streetsAvailability: $item->StreetsAvailability,
                parentRegionTypes: $item->ParentRegionTypes,
                parentRegionCode: $item->ParentRegionCode,
                regionTypes: $item->RegionTypes,
                regionTypesCode: $item->RegionTypesCode
            );
        })->toArray();
    }
}
