<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kossa\AlgerianCities\Models\Wilaya;

class WilayaFactory extends Factory
{
    protected $model = Wilaya::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'arabic_name' => $this->faker->city,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
        ];
    }
}
