<?php

namespace Database\Seeders;

use App\Enums\LocalesEnum;
use App\Models\Slide;
use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slider = Slider::factory()->count(1)->create();
        for ($i = 0; $i < fake()->numberBetween(2, 5); $i++) {
            $slide = Slide::factory()->create([
                'slider_id' => $slider->first()->id
            ]);
            $data = [];
            foreach (LocalesEnum::getValues() as $locale) {
                $data["before_title_$locale"] = fake()->unique()->word;
                $data["title_$locale"] = fake()->unique()->word;
                $data["after_title_$locale"] = fake()->unique()->word;
                $data["description_$locale"] = fake()->text;
                $data["bg_letter_$locale"] = fake()->randomLetter;
                $data["action_btn_text_$locale"] = fake()->unique()->word;
            }

            $slide->addTranslations($data, 'slide');
        }
    }
}
