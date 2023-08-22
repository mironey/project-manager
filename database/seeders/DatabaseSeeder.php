<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Assignment;
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
        $permissions= ['manage projects', 'delete projects', 'publish projects', 'unpublish projects', 'manage tasks', 'delete tasks', 'publish tasks', 'unpublish tasks', 'manage assignments', 'delete assignments', 'publish assignments', 'unpublish assignments'];
        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role1 = Role::create(['name' => 'super-admin']);

        $user = User::factory()->create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role1);

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('manage projects');
        $role2->givePermissionTo('delete projects');
        $role2->givePermissionTo('publish projects');
        $role2->givePermissionTo('unpublish projects');

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role2);

        $role3 = Role::create(['name' => 'manager']);
        $role3->givePermissionTo('manage tasks');
        $role3->givePermissionTo('delete tasks');
        $role3->givePermissionTo('publish tasks');
        $role3->givePermissionTo('unpublish tasks');

        $user = User::factory()->create([
            'name' => 'Manager One',
            'email' => 'manager@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role3);

        $user = User::factory()->create([
            'name' => 'Manager Two',
            'email' => 'manager2@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role3);

        $user = User::factory()->create([
            'name' => 'Manager Three',
            'email' => 'manager3@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role3);

        $role4 = Role::create(['name' => 'supervisor']);
        $role4->givePermissionTo('manage assignments');
        $role4->givePermissionTo('delete assignments');
        $role4->givePermissionTo('publish assignments');
        $role4->givePermissionTo('unpublish assignments');

        $user = User::factory()->create([
            'name' => 'Supervisor One',
            'email' => 'supervisor@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role4);

        $user = User::factory()->create([
            'name' => 'Supervisor Two',
            'email' => 'supervisor2@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role4);

        $user = User::factory()->create([
            'name' => 'Supervisor Three',
            'email' => 'supervisor3@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role4);

        $role5 = Role::create(['name' => 'member']);
        $role5->givePermissionTo('publish assignments');
        $role5->givePermissionTo('unpublish assignments');

        $user = User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@project.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($role5);

        User::factory(12)->afterCreating(function (User $user) use ($role5) {
            $user->assignRole($role5);
        })->create();

        Project::factory(7)->create();
        Task::factory(21)->create();
        Assignment::factory(63)->create();
        Comment::factory(190)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
