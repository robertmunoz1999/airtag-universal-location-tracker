<?php

namespace Database\Seeders;

use Database\Factories\AirtagFactory;
use Illuminate\Database\Seeder;

class AirtagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AirtagFactory::times(5)->create();
        AirtagFactory::times(3)->create([
            'identifier' => 'Sandero',
            'name' => 'Sandero',
        ]);
        AirtagFactory::times(3)->create([
            'identifier' => 'Panda',
            'name' => 'Panda',
        ]);
    }
}
