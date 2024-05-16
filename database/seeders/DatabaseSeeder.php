<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Controllers\UserController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $user = User::first();
        $user->name = 'Admin';
        $user->email = 'user@example.com';
        $user->password = bcrypt('password');
    }
}
