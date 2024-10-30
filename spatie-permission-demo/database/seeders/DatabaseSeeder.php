<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Permission::create(['name'=> 'publish articles']);
        Permission::create(['name'=> 'edit articles']);
        Permission::create(['name'=> 'delete articles']);

        $writerRole = Role::create(['name' => 'writer']);
        $adminRole = Role::create(['name' => 'admin']);
        // dd($writerRole);

        $writerRole->givePermissionTo('publish articles');
        $adminRole->givePermissionTo(Permission::all());

        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'John R',
            'email' => 'john@example.com',
        ]);

        $user1->assignRole('writer');
        $user2->assignRole('admin');
    }
}
