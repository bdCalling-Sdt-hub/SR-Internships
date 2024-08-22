<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            "name"      => "user 1",
            "email"     => "user1@gmail.com",
            "password"  => bcrypt("12345678"),
            "role"      => "0",
            "status"    => "1",
        ]);
        // User::create([
        //     "name"      => "user 2",
        //     "email"     => "user2@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);
        // User::create([
        //     "name"      => "user 3",
        //     "email"     => "user3@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);
        // User::create([
        //     "name"      => "user 4",
        //     "email"     => "user4@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);
        // User::create([
        //     "name"      => "user 5",
        //     "email"     => "user5@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);


        // User::create([
        //     "name"      => "user 6",
        //     "email"     => "user6@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);
        // User::create([
        //     "name"      => "user 7",
        //     "email"     => "user7@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);
        // User::create([
        //     "name"      => "user 8",
        //     "email"     => "user8@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);
        // User::create([
        //     "name"      => "user 9",
        //     "email"     => "user9@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);
        // User::create([
        //     "name"      => "user 10",
        //     "email"     => "user10@gmail.com",
        //     "password"  => bcrypt("12345678"),
        //     "role"      => "0",
        //     "status"    => "1",
        // ]);

    }
}
