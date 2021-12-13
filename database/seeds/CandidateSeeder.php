<?php

use App\Model\Candidate;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class CandidateSeeder
 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $regionals = User::whereHas('roles', function ($query) {
            $query->where('name', User::REGIONAL_ROLE);
        })->get();
        foreach ($regionals as $regional) {
            $candidate = Candidate::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'regional_id' => $regional->id,
            ]);
        }
    }
}
