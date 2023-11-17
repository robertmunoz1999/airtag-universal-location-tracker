<?php

namespace Database\Factories;

use App\Models\Airtag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirtagFactory extends Factory
{
    protected $model = Airtag::class;

    public function definition(): array
    {
        return [
            'identifier' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'located_at' => Carbon::now(),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
