<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaModule>
 */
class MediaModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $module = Module::get()->id;
        return [
            'module_id' => $this->faker->unique()->rand($module),
            'title' => $this->faker->title(),
            'video_url' => "https://www.youtube.com/embed/PjB7cAF0jSc?list=RDBb69TOfPXn8",
            'no_media' => 1,
        ];
    }
}
