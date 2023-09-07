<?php

namespace App\DTO\NovaPoshta;

class NpOwnershipFormDTO
{
    public string $ref;
    public string $description;
    public string $fullName;

    /**
     * @param object $data
     */
    public function __construct(object $data)
    {
        $this->ref = $data->Ref ?? '';
        $this->description = $data->Description ?? '';
        $this->fullName = $data->FullName ?? '';
    }

}
