<?php

namespace App\Models\Traits;

use App\Enums\LocalesEnum;
use App\Models\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait TranslatableTrait
{
    /**
     * The columns for translation in different groups.
     *
     * @var array<string, array<int, string>>
     */
    private array $translation_columns = [
        'general' => [
            'name',
            'description',
        ],
        'slide' => [
            'title',
        ],
        'product' => [
            'feature-name',
            'feature-text',
        ],
        'feature' => [
            'name',
            'text',
        ],
        'pages' => [
            'title',
            'description',
            'keywords',
            'sale_title',
            'sale_text',
            'deal_title',
            'deal_description',
        ],
        'layout' => [
            'name',
            'top_header_text',
            'address',
        ],
    ];

    /**
     * Add translations for the given data.
     *
     * @param array $data The data to be translated.
     * @param string $columns_group The group of columns to be translated.
     * @return void
     */
    public function addTranslations(array $data, string $columns_group = 'general'): void
    {
        foreach (LocalesEnum::getValues() as $locale) {
            foreach ($this->translation_columns[$columns_group] as $translation_column) {
                $nameKey = $translation_column . '_' . $locale;
                if (isset($data[$nameKey])) {
                    $this->translations()
                        ->updateOrCreate(
                            [
                                'key' => $translation_column,
                                'locale' => $locale,
                            ],
                            [
                                'value' => $data[$nameKey],
                                'key' => $translation_column,
                                'locale' => $locale,
                            ]
                        );
                }
            }
        }
    }

    /**
     * Get the translations' relationship.
     *
     * @return MorphMany
     */
    public function translations(): MorphMany
    {
        return $this->morphMany(Translatable::class, 'translatable');
    }

    /**
     * Get the translation for the given key and locale.
     *
     * @param string $key The translation key.
     * @param string|null $locale The locale for the translation.
     * @return string|null
     */
    public function trans(string $key, string $locale = null): string|null
    {
        if (!$locale) {
            $locale = app()->getLocale();
        }
        return $this->translations
            ->where('key', $key)
            ->where('locale', $locale)
            ->first()?->value ?? null;
    }

    /**
     * Get the Ukrainian translation for the given key.
     *
     * @param string $key The translation key.
     * @return string|null
     */
    public function transUA(string $key): string|null
    {
        return $this->trans($key, LocalesEnum::UA->value);
    }

    /**
     * Get the English translation for the given key.
     *
     * @param string $key The translation key.
     * @return string|null
     */
    public function transEN(string $key): string|null
    {
        return $this->trans($key, LocalesEnum::EN->value);
    }

    /**
     * Get the name attribute, with fallback to translations or the original value.
     *
     * @param mixed $value The original value.
     * @return string|null
     */
    public function getNameAttribute(mixed $value): ?string
    {
        return $this->trans('name') ?? $value ?? $this->key;
    }

    /**
     * Get the description attribute, with fallback to translations or the original value.
     *
     * @param mixed $value The original value.
     * @return string|null
     */
    public function getDescriptionAttribute(mixed $value): ?string
    {
        return $this->trans('description') ?? $value;
    }
}
