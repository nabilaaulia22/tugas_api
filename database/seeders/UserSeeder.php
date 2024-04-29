<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\LaravelIgnition\Support\LaravelVersion;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name'=>'Nabila Aulia',
            'level'=>'admin',
            'email'=>'nabila@gmail.com',
            'password'=>bcrypt('12345'),
            'remember_token'=>Str::random(60),
        ]);

    }
}
