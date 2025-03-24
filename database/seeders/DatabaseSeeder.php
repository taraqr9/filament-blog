<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Enums\UserStatus;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Technology & Innovation',
            'Health & Wellness',
            'Travel & Adventure',
            'Business & Finance',
            'Food & Cooking',
            'Education & Learning',
            'Entertainment & Media',
            'Sports & Fitness',
            'Science & Nature',
            'Personal Development',
        ];

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $userRole = Role::create(['name' => 'user']);

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
        $superAdmin->syncRoles('super-admin');

        User::factory()->count(20)->create();
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => fake()->slug(),
                'description' => fake()->text(),
                'status' => Status::Active,
            ]);
        }
        Blog::factory()->count(120)->create();
    }
}
