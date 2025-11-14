<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(
            ['name' => UserRoleEnum::ADMIN->value],
            [
                'name' => UserRoleEnum::ADMIN->value,
                'guard_name' => 'web'
            ]
        );
        Role::updateOrCreate(
            ['name' => UserRoleEnum::USER->value],
            [
                'name' => UserRoleEnum::USER->value,
                'guard_name' => 'web'
            ]
        );
        
    }
}