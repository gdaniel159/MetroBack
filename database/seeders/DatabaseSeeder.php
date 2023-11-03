<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DefaultUserSeeder::class);
        $this->call(CategoriesSeeder::class);
    }
}
