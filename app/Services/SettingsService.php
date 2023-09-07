<?php

namespace App\Services;

use App\Contracts\SettingsRepositoryInterface;
use App\Contracts\SettingsServiceInterface;
use App\Enums\SettingsEnum;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;

class SettingsService implements SettingsServiceInterface
{
    /**
     * @var SettingsRepositoryInterface|(SettingsRepositoryInterface&Application)|Application|\Illuminate\Foundation\Application|mixed
     */
    private mixed $settingsRepository;

    public function __construct()
    {
        $this->settingsRepository = app(SettingsRepositoryInterface::class);
    }

    public function getCitySender(): ?Setting
    {
        return $this->settingsRepository->getSetting(SettingsEnum::CITY_SENDER->value);
    }

    public function setCitySender(object $city)
    {
        return $this->settingsRepository->setSetting(SettingsEnum::CITY_SENDER->value, $city);
    }
}
