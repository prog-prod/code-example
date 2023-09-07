<?php

namespace App\DTO\NovaPoshta;

class NpCargoDescriptionItemDTO
{
    public string $description;
    public string $descriptionRu;
    public string $ref;

    /**
     * @param object $data
     */
    public function __construct(object $data)
    {
        $this->description = $data->Description ?? '';
        $this->descriptionRu = $data->DescriptionRu ?? '';;
        $this->ref = $data->Ref ?? '';;
    }
}
