<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $course = Course::get()->id;
        return [
            'course_id' => $this->faker->unique()->rand($course),
            'title' => $this->faker->title(),
            'file' => $this->faker->url(),
            'no_module' => 1
        ];
    }
}
