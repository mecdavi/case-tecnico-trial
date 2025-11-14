<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\UserRoleEnum;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@teste.com',
            'password' => bcrypt('123456')
        ]);

        $user2 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'userAdmin@example.com',
            'password' => bcrypt('neneVasco123'),
        ]);

        $user3 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'userClient@example.com',
            'password' => bcrypt('neneVasco123'),
        ]);

        // roda só uma vez
        $this->call(UserRoleSeeder::class);

        // agora sim: usando ->value
        $user1->assignRole(UserRoleEnum::ADMIN->value);
        $user2->assignRole(UserRoleEnum::ADMIN->value);
        $user3->assignRole(UserRoleEnum::USER->value);
    }
}
