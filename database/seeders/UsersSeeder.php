<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        User::create([
            'name' => "Admin",
            'last_name' => "Admin",
            'rol' => 1,
            'phone' => $faker->unique()->phoneNumber,
            'country_id' => rand(1, 100), 
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), 
        ]);

        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'rol' => 0,
                'phone' => $faker->unique()->phoneNumber,
                'country_id' => rand(1, 253), 
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'), 
                'rol' => 0
            ]);
        }
    }
}