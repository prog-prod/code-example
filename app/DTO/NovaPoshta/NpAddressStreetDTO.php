<?php

namespace App\DTO\NovaPoshta;

use stdClass;

class NpAddressStreetDTO
{
    public string $present;
    public NpLocationStreetDTO $location;
    public string $settlementRef;
    public string $settlementStreetDescription;
    public string $settlementStreetDescriptionRu;
    public string $settlementStreetRef;
    public string $streetsType;
    public string $streetsTypeDescription;

    public function __construct(
        string $present,
        stdClass $location,
        string $settlementRef,
        string $settlementStreetDescription,
        string $settlementStreetDescriptionRu,
        string $settlementStreetRef,
        string $streetsType,
        string $streetsTypeDescription
    ) {
        $this->present = $present;
        $this->location = new NpLocationStreetDTO(lat: $location->lat, lon: $location->lon);
        $this->settlementRef = $settlementRef;
        $this->settlementStreetDescription = $settlementStreetDescription;
        $this->settlementStreetDescriptionRu = $settlementStreetDescriptionRu;
        $this->settlementStreetRef = $settlementStreetRef;
        $this->streetsType = $streetsType;
        $this->streetsTypeDescription = $streetsTypeDescription;
    }
}
