<?php

namespace Database\Seeders;

use App\Models\Profile;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id');

        Profile::query()
            ->create([
                'cover' => $faker->imageUrl(720, 720, 'automotive'),
                'address' => $faker->address,
                'short_description' => $faker->paragraph(10),
                'description' => $faker->paragraph(100),
            ]);
    }
}
