<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'joao@teste.com'],
            [
                'name' => 'Joao',
                'password' => bcrypt('123456'),
            ]
        );
    }
}