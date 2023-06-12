<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $data = [
            [
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('user'),
                'full_name' => 'user',
                'address' => $faker->address,
                'gender' => 1,
                'phone' => $faker->e164PhoneNumber(),
                'avatar' => 'img/icon_avatar.jpg',
                'city' => $faker->city()
            ]
        ];

        foreach ($data as $key => $value) {
            User::create([
                'username' => $value['username'],
                'email' => $value['email'],
                'password' => $value['password'],
                'full_name' => $value['full_name'],
                'address' => $value['address'],
                'gender' => $value['gender'],
                'phone' => $value['phone'],
                'avatar' => $value['avatar'],
                'city' => $value['city'],
                'is_active' => 1
            ]);
        }
    }
}
