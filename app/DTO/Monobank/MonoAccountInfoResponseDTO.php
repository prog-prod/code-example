<?php

namespace App\DTO\Monobank;

class MonoAccountInfoResponseDTO
{
    public ?string $clientId;
    public ?string $name;
    public ?string $webHookUrl;
    public ?string $permissions;
    public array $accounts;
    public array $jars;

    /**
     * @param array $data
     */

    public function __construct(array $data)
    {
        $this->clientId = $data['clientId'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->webHookUrl = $data['webHookUrl'] ?? null;
        $this->permissions = $data['permissions'] ?? null;
        $this->accounts = collect($data['accounts'] ?? [])->map(function ($account) {
            return new MonoAccountDTO($account);
        })->toArray();
        $this->jars = collect($data['jars'] ?? [])->map(function ($jar) {
            return new MonoJarDTO($jar);
        })->toArray();;
    }
}
