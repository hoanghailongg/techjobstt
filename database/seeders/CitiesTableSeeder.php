<?php

namespace Database\Seeders;


use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents('https://provinces.open-api.vn/api/?depth=1'), true);

        foreach ($data as $key => $value) {
            City::create([
                'name' => $value['name']
            ]);
        }
    }
}
