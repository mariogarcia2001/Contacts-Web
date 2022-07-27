<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'number' => $this->faker->name,
			'email' => $this->faker->name,
			'organization' => $this->faker->name,
			'charge' => $this->faker->name,
        ];
    }
}
