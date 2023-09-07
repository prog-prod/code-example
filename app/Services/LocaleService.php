<?php

namespace App\Services;

use App\Enums\LocalesEnum;

class LocaleService
{
    /**
     * The available locales.
     *
     * @var array
     */
    private array $locales;

    /**
     * The fallback locale.
     *
     * @var string
     */
    private string $fallback_locale;

    /**
     * The current locale.
     *
     * @var string
     */
    private string $locale;

    /**
     * Create a new LocaleService instance.
     */
    public function __construct()
    {
        $this->locales = collect(LocalesEnum::cases())->map(fn($d) => $d->value)->toArray();
        $this->fallback_locale = config('app.fallback_locale');
        $this->locale = $this->fallback_locale;
    }

    /**
     * Get the available locales.
     *
     * @return array
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    /**
     * Get the current locale.
     *
     * @return string
     */
    public function getLocale(): string
    {
        return app()->getLocale();
    }

    /**
     * Set the locale.
     *
     * @param string $lang The locale language code.
     * @param bool $rewriteSession Whether to rewrite the locale in the session.
     * @return void
     */
    public function setLocale(string $lang, bool $rewriteSession = true): void
    {
        $locale = LocalesEnum::from($lang)->value;
        if ($rewriteSession) {
            session()->put("locale", $locale);
        }
        app()->setLocale($lang);
    }

    /**
     * Get the fallback locale.
     *
     * @return string
     */
    public function getFallbackLocale(): string
    {
        return $this->fallback_locale;
    }
}
