<?php

namespace App\DTO\NovaPoshta;

class NpLocationStreetDTO
{
    public int $lat;
    public int $lon;

    public function __construct(int $lat, int $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }
}
