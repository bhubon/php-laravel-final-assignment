<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create(
            [
                'first_name' => 'Bhubon',
                'last_name' => 'Sd',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('111'),
                'role' => 'admin',
                'status' => 'active',
            ],
        );

        \App\Models\User::create(
            [
                'first_name' => 'NIl',
                'last_name' => 'Sd',
                'email' => 'company@gmail.com',
                'password' => bcrypt('111'),
                'role' => 'company',
                'status' => 'active',
            ],
        );

        \App\Models\User::create(
            [
                'first_name' => 'Avro',
                'last_name' => 'Sd',
                'email' => 'candidate@gmail.com',
                'password' => bcrypt('111'),
                'role' => 'candidate',
                'status' => 'active',
            ],
        );
    }
}
