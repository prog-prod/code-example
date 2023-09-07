<?php

namespace App\DTO\NovaPoshta;

class NpDataStreetDTO
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
            return new NpAddressStreetDTO(
                present: $item->Present,
                location: $item->Location,
                settlementRef: $item->SettlementRef,
                settlementStreetDescription: $item->SettlementStreetDescription,
                settlementStreetDescriptionRu: $item->SettlementStreetDescriptionRu,
                settlementStreetRef: $item->SettlementStreetRef,
                streetsType: $item->StreetsType,
                streetsTypeDescription: $item->StreetsTypeDescription
            );
        })->toArray();
    }
}
