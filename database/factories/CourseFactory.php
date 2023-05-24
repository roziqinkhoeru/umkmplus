<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mentor = Customer::whereHas('user', function ($query) {
            $query->whereHas('roleUser', function ($query) {
                $query->whereHas('role', function ($query) {
                    $query->where('name', 'mentor');
                });
            });
        })->pluck('id')->toArray();
        return [
            'mentor_id' => $this->faker->randomElement($mentor),
            'category_id' => $this->faker->rand(1, 3),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'thumbnail' => $this->faker->imageUrl(),
            'price' => $this->faker->rand(50000, 1000000),
        ];
    }
}
