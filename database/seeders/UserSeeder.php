<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@unj.ac.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'superadmin',
                'email' => 'superadmin@unj.ac.id',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin',
            ],
            [
                'name' => 'kepalaupt',
                'email' => 'kepalaupt@unj.ac.id',
                'password' => Hash::make('kepalaupt123'),
                'role' => 'kepalaupt',
            ],
            [
                'name' => 'supkorla',
                'email' => 'supkorla@unj.ac.id',
                'password' => Hash::make('supkorla123'),
                'role' => 'supkorla',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

         // Membuat 50 user dummy
        // User::factory()->count(100)->create();

    }
}
