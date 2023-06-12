<?php

namespace Database\Seeders;


use App\Models\City;
use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            'Java',
            'Python',
            'Tester',
            'QA QC',
            '.NET',
            'Javascript',
            'Business Analyst',
            'Designer'
        ];

        foreach ($data as $key => $value) {
            Language::create([
                'name' => $value
            ]);
        }
    }
}
