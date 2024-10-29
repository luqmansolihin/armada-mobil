<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['daihatsu', 'isuzu'];

        foreach ($brands as $brand) {
            ProductBrand::query()
                ->create([
                    'name' => $brand
                ]);
        }
    }
}
