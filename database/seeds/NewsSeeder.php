<?php

use App\Model\News;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $regionals = User::whereHas('roles', function ($q) {
            $q->where('name', User::REGIONAL_ROLE)
              ->orWhere('name', User::INDIVIDUAL_ROLE);
        })->get();
        foreach ($regionals as $regional) {
            for ($i = 0; $i < 5; $i++) {
                $news = News::create([
                    'title' => $faker->sentence(10),
                    'description' => $faker->paragraph(10),
                    'user_id' => $regional->id,
                    'status' => $faker->randomElement(['Active', 'Inactive']),
                ]);
            }
        }
    }
}
