<?php

namespace App\DTO\NovaPoshta;

class NpCargoItemDTO
{
    public string $description;
    public string $ref;

    /**
     * @param $item
     */
    public function __construct($item)
    {
        $this->description = $item->Description ?? '';
        $this->ref = $item->Ref ?? '';
    }

}
