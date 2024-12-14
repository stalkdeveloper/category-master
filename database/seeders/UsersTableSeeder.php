<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'                      => 'Admin',
                'email'                      => 'admin@gmail.com',
                'password'                => Hash::make('Admin@1234'),
                'remember_token'    => null,
                'email_verified_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'                      => "User",
                'email'                       => 'user@gmail.com',
                'password'                => Hash::make('User@1234'),
                'remember_token'    => null,
                'email_verified_at'     => date('Y-m-d H:i:s'),

            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
