<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = json_decode(file_get_contents(public_path('geolocs/cities.json'), true));

        foreach ($cities as $city)
        {
            City::query()->create([
                'name' => $city->kota
            ]);
        }
    }
}
