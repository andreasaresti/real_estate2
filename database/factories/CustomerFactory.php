<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ext_code' => $this->faker->unique->text(255),
            'type' => $this->faker->word,
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName,
            'company_name' => $this->faker->text(255),
            'email' => $this->faker->unique->email,
            'password' => $this->faker->password,
            'mobile' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->text(255),
            'city' => $this->faker->city,
            'district' => $this->faker->text(255),
            'country' => $this->faker->country,
            'notes' => $this->faker->text,
            'customer_role_id' => \App\Models\CustomerRole::factory(),
        ];
    }
}
