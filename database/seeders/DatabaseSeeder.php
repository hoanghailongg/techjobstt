<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(UsersTableSeeder::class);
         $this->call(AdminsTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
         $this->call(CompaniesTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(JobsTableSeeder::class);
         $this->call(LanguagesTableSeeder::class);
    }
}