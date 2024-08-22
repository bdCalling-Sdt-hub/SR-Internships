<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"      => "Admin Camille",
            "email"     => "admin@gmail.com",
            "password"  => bcrypt("12345678"),
            "role"      => "1",
            "status"    => "1",
        ]);
    }
}
