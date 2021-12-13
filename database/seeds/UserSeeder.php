<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            $country = $faker->country();
            $regional = User::create([
                'name' => $country,
                'email' => Str::slug($country) . '@gmail.com',
                'username' => Str::slug($country),
                'password' => Hash::make('password'),
            ]);
            $regional->assignRole(User::REGIONAL_ROLE);
        }
        for ($i = 0; $i < 5; $i++) {
            $name = $faker->firstName(). ' '.$faker->lastName();
            $individualCandidate = User::create([
                'name' => $name,
                'email' => Str::slug($name).'@gmail.com',
                'username' => Str::slug($name),
                'password' => Hash::make('password'),
            ]);
            $individualCandidate->assignRole(User::INDIVIDUAL_ROLE);
        }
    }
}
