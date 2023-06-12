<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $data = [
            [
                'email' => 'nhatuyendung@example.com',
                'password' => Hash::make('nhatuyendung'),

                'full_name' => 'NTD FPT Software',
                'phone' => '123-456-7890',
                'name' => 'FPT Software',
                'address' => '123 Main St',
                'avatar' => 'companies/fpt-logo.png',
                'url' => 'https://www.fpt-software.com/',
                'introduce' => 'Hello',
                'size' => '2000+ nhân viên',
            ],
            [
                'password' => Hash::make('mgm'),
                'full_name' => 'NTD mgm technology',
                'avatar' => 'companies/nvg-logo.png',
                'name' => 'mgm technology',
                'email' => 'mgm@example.com',
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber(),
                'introduce' => 'Introduction',
                'size' => '2000+ nhân viên',
                'url' => 'https://mgmtp.hire.trakstar.com/',
            ],
            [
                'password' => Hash::make('alipay'),
                'full_name' => 'NTD ALIPAY Software',
                'avatar' => 'companies/alipay-logo.png',
                'name' => 'ALIPAY Software',
                'email' => $faker->companyEmail(),
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber(),
                'introduce' => 'Introduction',
                'size' => '2000+ nhân viên',
                'url' => 'https://www.alipay.com/'
            ],
            [
                'password' => Hash::make('luxoft'),
                'full_name' => 'NTD Luxoft Software',
                'avatar' => 'companies/luxoft-vietnam-logo.png',
                'name' => 'Luxoft Software',
                'email' => $faker->companyEmail(),
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber(),
                'introduce' => 'Introduction',
                'size' => '2000+ nhân viên',
                'url' => 'https://www.luxoft.com',
            ],
            [
                'password' => Hash::make('techcombank'),
                'full_name' => 'NTD Techcombank',
                'avatar' => 'companies/techcombank-logo.png',
                'name' => 'Techcombank',
                'email' => $faker->companyEmail(),
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber(),
                'introduce' => 'Introduction',
                'size' => '2000+ nhân viên',
                'url' => 'https://techcombank.com',
            ],
            [
                'password' => Hash::make('credit'),
                'full_name' => 'NTD Home Credit',
                'avatar' => 'companies/home-credit.png',
                'name' => 'Home Credit',
                'email' => $faker->companyEmail(),
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber(),
                'introduce' => 'Introduction',
                'size' => '2000+ nhân viên',
                'url' => 'https://www.homecredit.vn/',
            ],
            [
                'password' => Hash::make('grab'),
                'full_name' => 'NTD Grab (Vietnam) Ltd',
                'avatar' => 'companies/grab-vietnam.png',
                'name' => 'Grab (Vietnam) Ltd.',
                'email' => $faker->companyEmail(),
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber(),
                'introduce' => 'Introduction',
                'size' => '2000+ nhân viên',
                'url' => 'https://www.grab.com/',
            ],
            [
                'password' => Hash::make('techbase'),
                'full_name' => 'NTD Techbase Vietnam',
                'avatar' => 'companies/HINH.png',
                'name' => 'Techbase Vietnam',
                'email' => $faker->companyEmail(),
                'address' => $faker->address,
                'phone' => $faker->e164PhoneNumber(),
                'introduce' => 'Introduction',
                'size' => '2000+ nhân viên',
                'url' => 'https://www.techbasevn.com/',
            ],
        ];

        foreach ($data as $key => $value) {
            Company::create([
                'password' => $value['password'],
                'full_name' => $value['full_name'],
                'avatar' => $value['avatar'],
                'name' => $value['name'],
                'email' => $value['email'],
                'address' => $value['address'],
                'phone' => $value['phone'],
                'introduce' => $value['introduce'],
                'size' => $value['size'],
                'url' => $value['url'],
                'is_active' => 1
            ]);
        }
    }
}
