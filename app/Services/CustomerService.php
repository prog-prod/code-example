<?php

namespace App\Services;

use App\Contracts\CustomerRepositoryInterface;
use App\Contracts\CustomerServiceInterface;
use Exception;

class CustomerService implements CustomerServiceInterface
{

    private CustomerRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app(CustomerRepositoryInterface::class);
    }

    public function createCustomerIfNotExist(array $data)
    {
        return $this->repository->updateOrCreateCustomer($data);
    }

    /**
     * @throws Exception
     */
    public function generateAddress(): string
    {
        $country = $this->getCountry();
        $city = $this->getCity();

        return join(',', [$country, $city]);
    }

    /**
     * @throws Exception
     */
    public function getCity(): ?string
    {
        return geoip()->getLocation()->city;
    }

    /**
     * @throws Exception
     */
    public function getState(): ?string
    {
        return geoip()->getLocation()->state_name ?? geoip()->getLocation()->state;
    }

    /**
     * @throws Exception
     */
    public function getCoordinates(): ?string
    {
        return collect([geoip()->getLocation()->lat, geoip()->getLocation()->lon])->toJson();
    }

    /**
     * @throws Exception
     */
    public function getCountry(): ?string
    {
        return geoip()->getLocation()->country;
    }

    /**
     * @throws Exception
     */
    public function getIpAddress(): ?string
    {
        return geoip()->getLocation()->ip;
    }

    /**
     * @throws Exception
     */
    public function getCurrency(): ?string
    {
        return geoip()->getLocation()->currency;
    }

    /**
     * @throws Exception
     */
    public function getPostalCode(): ?string
    {
        return geoip()->getLocation()->postal_code;
    }
}
