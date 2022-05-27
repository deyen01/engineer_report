<?php

namespace Database\Seeders;

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
                'email' => 'admin@example.org',
                'access_level' => 2,
                'enabled' => TRUE,
                'password' => Hash::make('XvAEuEOKrZv7m0g9')
            ],
            [
                'name' => 'moder',
                'email' => 'moder@example.org',
                'access_level' => 1,
                'enabled' => TRUE,
                'password' => Hash::make('aW92gGbcZGLGQkGJ')
            ],
            [
                'name' => 'user',
                'email' => 'user@example.org',
                'access_level' => 0,
                'enabled' => TRUE,
                'password' => Hash::make('YptdOpESyT12nVby')
            ]
        ]);
    }
}
