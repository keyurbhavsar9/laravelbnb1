<?php

namespace Database\Seeders;

use App\Models\Bookable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BookablesTableSeeder::class);
        $this->call(BookingsTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
    }
}