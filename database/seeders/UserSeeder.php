<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'username' => "admin",
            'email'=> "admin@gmail.com",
            'password' => Hash::make('123456'),
            'role'=>"admin",
            'no_hp'=>"0"
        ]);
        User::create([
            'username' => "akbar",
            'email'=> "akbarmaulana.am826@gmail.com",
            'password' => Hash::make('123456'),
            'role'=>"teknisi",
            'no_hp'=>"083809808665"
        ]);
    }
}
