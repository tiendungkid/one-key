<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            "email" => "phantiendung29111999@gmail.com"
        ], ["password" => Hash::make("Dungpro1"), "name" => "Tien Dung"]);
    }
}
