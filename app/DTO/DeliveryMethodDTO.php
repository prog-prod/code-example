<?php

namespace App\DTO;

class DeliveryMethodDTO
{
    public string $key;
    public string $name;


    public function __construct(string $key, string $name)
    {
        $this->name = $name;
        $this->key = $key;
    }
}
