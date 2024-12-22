<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'code' => 'K00232',
                'name' => 'Admin',
                'email' => 'admin@kiaisoft.com',
                'password' => Hash::make(env('PASS_ADMIN')),
                'role' => User::ROLE_ADMIN,
                'status' => User::IS_ACTIVE,
            ],
            [
                'code' => 'K00233',
                'name' => 'User One',
                'email' => 'user1@kiaisoft.com',
                'password' => Hash::make(env('PASS_USER')),
                'role' => User::ROLE_USER,
            ],
            [
                'code' => 'K00234',
                'name' => 'User Two',
                'email' => 'user2@kiaisoft.com',
                'password' => Hash::make(env('PASS_USER')),
                'role' => User::ROLE_USER,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
