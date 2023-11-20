<?php

namespace Database\Seeders;

use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make(1111),
                'role' => UserType::Administrator
            ],
            [
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make(1111),
                'role' => UserType::Subscriber
            ]
        ]);

    }
}
