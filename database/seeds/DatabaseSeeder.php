<?php

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
        $this->call([
            SuperAdminSeeder::class,
            // UserSeeder::class,
            // CandidateSeeder::class,
            // NewsSeeder::class,
        ]);
    }
}