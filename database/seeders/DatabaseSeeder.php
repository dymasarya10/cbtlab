<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'adminlab23@juara.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            'identity_number' => '17200023',
        ]);

        \App\Models\Grade::create([
            'name' => '7',
            'level' => 'SMP',
        ]);
        \App\Models\Grade::create([
            'name' => '8',
            'level' => 'SMP',
        ]);
        \App\Models\Grade::create([
            'name' => '9',
            'level' => 'SMP',
        ]);

        \App\Models\Subject::create([
            'name' => 'MTK',
            'level' => 'SMP',
        ]);
        \App\Models\Subject::create([
            'name' => 'SBK',
            'level' => 'SMP',
        ]);
        \App\Models\Subject::create([
            'name' => 'PAI',
            'level' => 'SMP',
        ]);
    }
}
