<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ShieldSeeder::class);

        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@user.com'],
            User::factory()->raw([
                'name' => 'Admin',
                'password' => bcrypt('secret'),
                'status' => UserStatus::Active,
            ])
        );
        $superAdmin->syncRoles('super_admin');
    }
}
