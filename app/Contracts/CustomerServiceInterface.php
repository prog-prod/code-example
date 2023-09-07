<?php

namespace App\Contracts;

interface CustomerServiceInterface
{
    public function createCustomerIfNotExist(array $data);

    public function generateAddress();

    public function getCity();

    public function getState();

    public function getCountry();

    public function getPostalCode();

    public function getCurrency(): ?string;

    public function getIpAddress(): ?string;

    public function getCoordinates(): ?string;

}
