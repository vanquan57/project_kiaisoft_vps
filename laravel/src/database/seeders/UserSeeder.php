<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        $users = [
            [
                'code' => 'K00232',
                'name' => 'Admin',
                'email' => 'admin@kiaisoft.com',
                'password' => Hash::make('Levanquan12345@'),
                'role' => User::ROLE_ADMIN,
                'status' => User::STATUS_ACTIVE,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'code' => 'K00233',
                'name' => 'User One',
                'email' => 'user1@kiaisoft.com',
                'password' => Hash::make('Levanquan123456@'),
                'role' => User::ROLE_USER,
                'status' => User::STATUS_WAITING,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'code' => 'K00234',
                'name' => 'User Two',
                'email' => 'user2@kiaisoft.com',
                'password' => Hash::make('Levanquan123456@'),
                'role' => User::ROLE_USER,
                'status' => User::STATUS_WAITING,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ];

        User::insert($users);
    }
}
