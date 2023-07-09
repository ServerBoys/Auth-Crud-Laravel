<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-blog-posts']);
        Permission::create(['name' => 'edit-blog-posts']);
        Permission::create(['name' => 'delete-blog-posts']);

        Permission::create(['name' => 'comment-blog-posts']);

        $editorRole = Role::create(['name' => 'Editor']);
        $visitorRole = Role::create(['name' => "Visitor"]);

        $editorRole->givePermissionTo([
            'create-blog-posts',
            'edit-blog-posts',
            'delete-blog-posts',
        ]);
        $visitorRole->givePermissionTo([
            'comment-blog-posts'
        ]);
    }
}
