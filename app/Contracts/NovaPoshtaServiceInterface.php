<?php

namespace App\Contracts;

use App\DTO\NovaPoshta\NpCargoDescriptionItemDTO;
use App\DTO\NovaPoshta\NpOwnershipFormDTO;
use App\DTO\NovaPoshta\NpResponseDTO;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface NovaPoshtaServiceInterface
{
    public function searchSettlements(): NpResponseDTO;

    public function searchSettlementStreets(): NpResponseDTO;

    public function getCities(): NpResponseDTO;

    public function getWarehouses(string $cityRef = "", string $warehouseId = ""): NpResponseDTO;

    public function createTTN(Order $order);

    public function getCounterparties($counterpartyProperty = "Sender", $findByString = null): NpResponseDTO;


    public function getCargoTypes(): NpResponseDTO;

    public function getBackwardDeliveryCargoTypes(): NpResponseDTO;

    public function getTypesOfPayersForRedelivery(): NpResponseDTO;

    public function getFopOwnershipForm(): ?NpOwnershipFormDTO;

    public function getCargoDishesDescription(): NpCargoDescriptionItemDTO;

    public function getCargoClothDescription(): NpCargoDescriptionItemDTO;

    public function getCargoCupDescription(): NpCargoDescriptionItemDTO;

    public function getOwnershipFormsList(): NpResponseDTO;

    public function getCargoDescriptionList($findByString = ''): NpResponseDTO;

    public function getDocumentPrice(string $cityRecipientRef, array $cargoDetails, int $cost, float $weights);

    public function getCargoDetails(Collection $products, array $productQuantityMap): array;

    public function getDocumentDeliveryDate(string $cityRecipientRef): NpResponseDTO;

    public function getDocumentList(string $dateTimeFrom, string $dateTimeTo): NpResponseDTO;

}
