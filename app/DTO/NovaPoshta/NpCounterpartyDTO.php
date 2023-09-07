<?php

namespace App\DTO\NovaPoshta;

class NpCounterpartyDTO
{
    public string $description;
    public string $ref;
    public string $city;
    public string $counterparty;
    public string $firstName;
    public string $lastName;
    public string $middleName;
    public string $counterpartyFullName;
    public string $ownershipFormRef;
    public string $ownershipFormDescription;
    public string $edrpou;
    public string $counterpartyType;
    public string $trustedCounterpartyType;
    public string $cityDescription;

    /**
     * @param object $data
     */
    public function __construct(
        object $data,
    ) {
        $this->description = $data->Description ?? '';
        $this->ref = $data->Ref ?? '';
        $this->city = $data->City ?? '';
        $this->counterparty = $data->Counterparty ?? '';
        $this->firstName = $data->FirstName ?? '';
        $this->lastName = $data->LastName ?? '';
        $this->middleName = $data->MiddleName ?? '';
        $this->counterpartyFullName = $data->CounterpartyFullName ?? '';
        $this->ownershipFormRef = $data->OwnershipFormRef ?? '';
        $this->ownershipFormDescription = $data->OwnershipFormDescription ?? '';
        $this->edrpou = $data->EDRPOU ?? '';
        $this->counterpartyType = $data->CounterpartyType ?? '';
        $this->trustedCounterpartyType = $data->TrustedCounterpartyType ?? '';
        $this->cityDescription = $data->CityDescription ?? '';
    }


}
