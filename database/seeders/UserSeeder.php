<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user =   User::create([
                    'name' => 'user',
                    'email' => 'user@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('soyjoaco'), // password
                    ]);

                    $user->assignRole('user');
    }
}
