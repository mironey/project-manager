<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions= ['edit projects', 'delete projects', 'publish projects', 'unpublish projects'];
        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role1 = Role::create(['name' => 'member']);
        $role1->givePermissionTo('edit projects');
        $role1->givePermissionTo('delete projects');

        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo('edit projects');
        $role2->givePermissionTo('delete projects');
        $role2->givePermissionTo('publish projects');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('edit projects');
        $role2->givePermissionTo('delete projects');
        $role2->givePermissionTo('publish projects');
        $role2->givePermissionTo('unpublish projects');

        $role3 = Role::create(['name' => 'Super-Admin']);

        $user = User::factory()->create([
            'name' => 'Writer User',
            'email' => 'writer@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role1);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role3);

        User::factory(5)->create();
        Project::factory(5)->create();
        Task::factory(15)->create();
        Comment::factory(30)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
