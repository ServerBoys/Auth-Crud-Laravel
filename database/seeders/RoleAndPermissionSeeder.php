<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {

        Permission::create(['name' => 'create-blog-posts']);
        Permission::create(['name' => 'edit-blog-posts']);
        Permission::create(['name' => 'delete-blog-posts']);

        $editorRole = Role::create(['name' => 'Editor']);
        $visitorRole = Role::create(['name' => "Visitor"]);


        $editorRole->givePermissionTo([
            'create-blog-posts',
            'edit-blog-posts',
            'delete-blog-posts',
        ]);

        Permission::create(['guard_name' => 'api', 'name' => 'create-blog-posts']);
        Permission::create(['guard_name' => 'api', 'name' => 'edit-blog-posts']);
        Permission::create(['guard_name' => 'api', 'name' => 'delete-blog-posts']);

        $editorApiRole = Role::create(['guard_name' => 'api', 'name' => 'ApiEditor']);
        $visitorApiRole = Role::create(['guard_name' => 'api', 'name' => "ApiVisitor"]);


        $editorApiRole->givePermissionTo([
            'create-blog-posts',
            'edit-blog-posts',
            'delete-blog-posts',
        ]);
    }
}
