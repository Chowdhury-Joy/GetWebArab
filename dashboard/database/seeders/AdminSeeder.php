<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = app()->environment('local') ? 'password' : Str::random(16);

        User::updateOrCreate(['email' => 'admin@getwebarab.com'], [
            'name' => 'Admin',
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        if (!app()->environment('local')) {
            $this->command->info("Admin created with email: admin@getwebarab.com and password: {$password}");
        }
    }
}
