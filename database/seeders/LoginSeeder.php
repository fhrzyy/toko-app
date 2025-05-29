<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Login::create([
            'username' => 'kasir1@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        Login::create([
            'username' => 'kasir2@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        Login::create([
            'username' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}