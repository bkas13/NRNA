<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::updateOrCreate([
            'email' => 'superadmin@gmail.com'
        ], [
            'name' => 'Super Admin ',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
        ]);
        $superadmin->assignRole(User::SUPER_ADMIN_ROLE);

    }
}
