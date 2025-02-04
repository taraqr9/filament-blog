<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'super-admin']);

        $permissions = [
            'view_role', 'view_any_role', 'create_role', 'update_role', 'delete_role', 'delete_any_role',
            'view_user', 'view_any_user', 'create_user', 'update_user', 'delete_user', 'delete_any_user',
        ];

        foreach ($permissions as $permission) {
            $perm = Permission::create(['name' => $permission]);
            $superAdminRole->givePermissionTo($perm);
        }

        $superAdmin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@user.com',
            'password' => bcrypt('secret'),
            'status' => UserStatus::Active,
        ]);

        $superAdmin->assignRole('super-admin');

        User::factory()->count(20)->create();
    }
}
