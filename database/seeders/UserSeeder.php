<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's users.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@email.test'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password_hash' => Hash::make('admin'),
                'date_of_birth' => '1995-01-01',
                'address' => 'Admin Street 1',
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@email.test'],
            [
                'first_name' => 'Regular',
                'last_name' => 'User',
                'password_hash' => Hash::make('user'),
                'date_of_birth' => '1998-06-15',
                'address' => 'User Street 2',
                'is_admin' => false,
            ]
        );
    }
}
