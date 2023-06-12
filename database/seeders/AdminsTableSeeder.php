<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
                'full_name' => 'admin',
                'address' => $faker->address,
                'gender' => 1,
                'phone' => $faker->e164PhoneNumber(),
                'company' => $faker->company(),
                'city' => $faker->city(),
            ]
        ];

        foreach ($data as $key => $value) {
            Admin::create([
                'username' => $value['username'],
                'email' => $value['email'],
                'password' => $value['password'],
                'full_name' => $value['full_name'],
                'address' => $value['address'],
                'gender' => $value['gender'],
                'phone' => $value['phone'],
                'company' => $value['company'],
                'city' => $value['city'],
            ]);
        }
    }
}
