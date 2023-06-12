<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();


        $data = [
            [
                'title' => '[HN] 02 Solution Architects–Up to $2000',
                'level' => 'Nhân viên',
                'salary_start' => '1000',
                'salary_end' => '3000',
                'experience' => '1 năm',
                'gender' => 'Nam',
                'content' => 'MÔ TẢ CÔNG VIỆC',
                'state' => 1,
                'size' => null,
                'date_end' => date('Y-m-d'),
                'company_id' => 1,
            ],
            [
                'title' => 'Fullstack .NET Developer (Angular/React)',
                'level' => 'Nhân viên',
                'salary_start' => '2000',
                'salary_end' => '5000',
                'experience' => '1 năm',
                'gender' => 'Nam',
                'content' => 'MÔ TẢ CÔNG VIỆC',
                'state' => 1,
                'size' => null,
                'date_end' => Date('Y-m-d', strtotime("+" . $faker->numberBetween(10, 20) . " days")),
                'company_id' => 3,
            ],
            [
                'title' => 'Frontend Developer (JavaScript, ReactJS)',
                'level' => 'Nhân viên',
                'salary_start' => '2000',
                'salary_end' => '5000',
                'experience' => '1 năm',
                'gender' => 'Nam',
                'content' => 'MÔ TẢ CÔNG VIỆC',
                'state' => 1,
                'size' => null,
                'date_end' => Date('Y-m-d', strtotime("+" . $faker->numberBetween(10, 20) . " days")),
                'company_id' => 2,
            ],
        ];

        for ($i = 0; $i < 100; $i++) {
            $languages = array(1, 2, 3, 4, 5, 6, 7, 8);
            $newLength = rand(2, count($languages));
            $randomIndexes = array_rand($languages, $newLength);
            $newArr = array();
            foreach ($randomIndexes as $index) {
                $newArr[] = $languages[$index];
            }

            Job::create([
                'title' => $data[array_rand($data)]['title'],
                'level' => $data[array_rand($data)]['level'],
                'salary_start' => $data[array_rand($data)]['salary_start'],
                'salary_end' => $data[array_rand($data)]['salary_end'],
                'experience' => $data[array_rand($data)]['experience'],
                'languages' => json_encode($newArr),
                'gender' => $data[array_rand($data)]['gender'],
                'content' => $data[array_rand($data)]['content'],
                'state' => $data[array_rand($data)]['state'],
                'size' => $data[array_rand($data)]['size'],
                'date_end' => $data[array_rand($data)]['date_end'],
                'city_id' => rand(1, 63),
                'company_id' => $data[array_rand($data)]['company_id'],
                'count' => rand(10, 10000),
                'is_active' => 1
            ]);
        }

    }
}
