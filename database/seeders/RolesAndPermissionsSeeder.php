<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $arrayOfPermissionActions = ['read', 'create', 'update', 'delete'];
        $arrayOfPermissionNames = [
            'console',
            'headings',
            'publications',
            'special_projects',
            'users',
            'advertising',
            'comments',
            'media_files',
            'logs',
            'settings',
            'posters',
            'tags',
            'roles'
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) use($arrayOfPermissionActions) {
            return collect($arrayOfPermissionActions)->map(function ($action) use($permission) {
                return ['name' => $action . '-' . $permission, 'guard_name' => 'web'];
            });
        })->flatten(1);

        Permission::insert($permissions->values()->all());

        // create roles and assign created permissions

        $role = Role::create(['name' => 'Администратор']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Редактор']);
        $role->givePermissionTo(Permission::where('name', 'like', '%console%')
            ->orWhere('name', 'like', '%publications%')
            ->orWhere('name', 'like', '%posters%')
            ->orWhere('name', 'like', '%special_projects%')
            ->orWhere('name', 'like', '%comments%')
            ->orWhere('name', 'like', '%media_files%')
            ->orWhere('name', 'like', '%settings%')->get()
        );

        $role = Role::create(['name' => 'Автор']);
        $role->givePermissionTo(Permission::where('name', 'like', '%console%')
            ->orWhere('name', 'like', '%publications%')
            ->orWhere('name', 'like', '%media_files%')
            ->orWhere('name', 'like', '%settings%')->get()
        );
    }
}
