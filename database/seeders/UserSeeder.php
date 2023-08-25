<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
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
        $data1 = [
            'name' => 'Berliana '. Str::random(2) ,
            'email' => 'berli'. Str::random(2) .'@gmail.com',
            'password' => Hash::make('password'),
        ];
        $data2 = [
            'name' => 'Rina Hapsari '. Str::random(2) ,
            'email' => 'rihapsari'. Str::random(2) .'@gmail.com',
            'password' => Hash::make('password'),
        ];
        $data3 = [
            'name' => 'Dimas Cahyo '. Str::random(2) ,
            'email' => 'dimascahyo'. Str::random(2) .'@gmail.com',
            'password' => Hash::make('password'),
        ];
        $data4 = [
            'name' => 'Administrator'. Str::random(2) ,
            'email' => 'admin'. Str::random(2) .'@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ];
        \App\Models\User::create($data1);
        \App\Models\User::create($data2);
        \App\Models\User::create($data3);
        \App\Models\User::create($data4);
    }
}
