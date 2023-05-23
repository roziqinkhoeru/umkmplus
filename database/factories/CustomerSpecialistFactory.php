<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Specialist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerSpecialist>
 */
class CustomerSpecialistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerIds = Customer::pluck('id')->toArray();
        $customer = Customer::with('users', 'roleUsers')->whereId($this->faker->randomElement($customerIds));

        if ($customer->name == 2) {
            $specialist = $this->faker->randomElement([1,2]);
        } else if ($customer->role_id == 3) {
            $specialist = $this->faker->randomElement([3,4,5]);
        };

        return [
            'customer_id' => $customer->id,
            'specialist_id' => $specialist,
        ];
    }
}
