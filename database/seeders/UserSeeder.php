<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = Str::random(10);
        DB::table('users')->insert([
            'name' => $name,
            'email' => $name.'@example.com',
            'password' => Hash::make('password'),
        ]);        
        $name = Str::random(10);
        DB::table('users')->insert([
            'name' => $name,
            'email' => $name.'@example.com',
            'password' => Hash::make('password'),
        ]);        
        $name = Str::random(10);
        DB::table('users')->insert([
            'name' => $name,
            'email' => $name.'@example.com',
            'password' => Hash::make('password'),
        ]);        

    }
}
