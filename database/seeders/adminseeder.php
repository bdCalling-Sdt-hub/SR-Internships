<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
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
            "full_name" => "Company",
            "user_name" => "company",
            "email"     => "company@gmail.com",
            "password"  => bcrypt("12345678"),
            "user_type" => "COMPANY",
            "status"    => "active",
        ]);
        User::create([
            "full_name" => "Super Admin",
            "user_name" => "super-admin",
            "email"     => "superadmin@gmail.com",
            "password"  => bcrypt("12345678"),
            "user_type" => "SUPER-ADMIN",
            "status"    => "active",
        ]);


        CompanyProfile::create([
            "id"=> "1",
            "company_name" =>"Your Company name",
            "address"=>"Your address",
            "email"=>"company@gmail.com",
            "phone"=> "000000000",
            "summary"=>"Welcome to my company."

        ]);
    }
}
