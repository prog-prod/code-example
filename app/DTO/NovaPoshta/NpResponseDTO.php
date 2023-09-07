<?php

namespace App\DTO\NovaPoshta;

use Illuminate\Support\Collection;
use stdClass;

class NpResponseDTO
{
    public bool $success;
    public Collection $data;
    public array $errors;
    public array $warnings;
    public array|stdClass $info;
    public array $messageCodes;
    public array $errorCodes;
    public array $warningCodes;
    public array $infoCodes;

    public function __construct(
        bool $success,
        array $data,
        array $errors,
        array $warnings,
        array|stdClass $info,
        array $messageCodes,
        array $errorCodes,
        array $warningCodes,
        array $infoCodes
    ) {
        $this->success = $success;
        $this->data = collect($data);
        $this->errors = $errors;
        $this->warnings = $warnings;
        $this->info = $info;
        $this->messageCodes = $messageCodes;
        $this->errorCodes = $errorCodes;
        $this->warningCodes = $warningCodes;
        $this->infoCodes = $infoCodes;
    }
}
