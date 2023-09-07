<?php

namespace App\View\Components;

use App\Facades\LocaleFacade;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

class Translations extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $locale = LocaleFacade::getLocale();

//        $translations = Cache::rememberForever("translations_$locale", function () use ($locale) {
        $phpTranslations = [];
        $jsonTranslations = [];
        if (File::exists(base_path("lang/$locale"))) {
            $phpTranslations = collect(File::allFiles(base_path("lang/$locale")))
                ->filter(function ($file) {
                    return $file->getExtension() === "php";
                })->flatMap(function ($file) {
                    $fileTranslations = File::getRequire($file->getRealPath());

                    // Get the file name without the .php extension
                    $fileName = $file->getBasename('.php');

                    // Prefix each key in the file with the file name and a dot
                    return collect(\Arr::dot($fileTranslations))
                        ->mapWithKeys(function ($value, $key) use ($fileName) {
                            return ["$fileName.$key" => $value];
                        })
                        ->toArray();
                })->toArray();
        }

        if (File::exists(resource_path("js/locale/$locale.json"))) {
            $jsonTranslations = json_decode(File::get(resource_path("js/locale/$locale.json"), true));
            if (is_object($jsonTranslations)) {
                $jsonTranslations = (array)$jsonTranslations;
            }
        }
//            return array_merge($jsonTranslations, $phpTranslations);
//        });
        $translations = array_merge($jsonTranslations, $phpTranslations);
        return view('components.translations', compact('translations'));
    }
}
