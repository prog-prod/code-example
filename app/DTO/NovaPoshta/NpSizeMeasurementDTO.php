<?php

namespace App\DTO\NovaPoshta;

class NpSizeMeasurementDTO
{
    public int $height;
    public int $length;
    public int $width;

    /**
     * @param int $height
     * @param int $length
     * @param int $width
     */
    public function __construct(int $height, int $length, int $width)
    {
        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
    }
}
