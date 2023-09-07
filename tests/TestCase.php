<?php

namespace Tests;

use App\Enums\CurrencyEnum;
use App\Enums\GenderEnum;
use App\Enums\LocalesEnum;
use App\Models\AdminUser;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Gender;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\LaravelLocalization;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private $countriesCount = null;

    /**
     * @return null
     */
    public function getCountriesCount()
    {
        if (!$this->countriesCount) {
            $this->countriesCount = Country::count();
        }
        return $this->countriesCount;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        $this->generateCountriesIfNotExist();
        Storage::fake('public');
        Config::set('exchange_rates', config('currency.exchange_rates'));
    }

    protected function refreshApplicationWithLocale($locale): void
    {
        self::tearDown();
        putenv(LaravelLocalization::ENV_ROUTE_KEY . '=' . $locale);
        self::setUp();
    }

    protected function tearDown(): void
    {
        putenv(LaravelLocalization::ENV_ROUTE_KEY);
        parent::tearDown();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user, 'web');

        return $user;
    }

    protected function signInAsAdmin($user = null)
    {
        $user = $user ?: AdminUser::factory()->create();

        $this->actingAs($user, 'admin');

        return $user;
    }

    protected function signAsUser($user = null)
    {
        return $this->signIn($user);
    }

    protected function createSlider(): void
    {
        Slider::factory()->create([
            'name' => 'main'
        ]);
    }

    protected function generateCountriesIfNotExist(): void
    {
        if ($this->getCountriesCount() === 0) {
            Country::factory(10)->create();
        }
    }

    protected function assertTranslations($attributes, $classType): void
    {
        foreach ($attributes as $attribute => $value) {
            foreach (LocalesEnum::getValues() as $locale) {
                if (preg_match("/_$locale/", $attribute)) {
                    if (is_array($value)) {
                        foreach ($value as $subvalue) {
                            $this->assertDatabaseHas('translatables', [
                                'translatable_type' => $classType,
                                'locale' => $locale,
                                'key' => str_replace('_' . $locale, '', $attribute),
                                'value' => $value,
                            ]);
                        }
                    } else {
                        $this->assertDatabaseHas('translatables', [
                            'translatable_type' => $classType,
                            'locale' => $locale,
                            'key' => str_replace('_' . $locale, '', $attribute),
                            'value' => $value,
                        ]);
                    }
                }
            }
        }
    }

    protected function createGenders(): void
    {
        foreach (GenderEnum::cases() as $value) {
            Gender::firstOrCreate(['key' => $value->name]);
        }
    }

    protected function createCurrency()
    {
        return Currency::firstOrCreate([
            'name' => CurrencyEnum::UAH->value,
            'code' => CurrencyEnum::UAH->name
        ]);
    }
}
