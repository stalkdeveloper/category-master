<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionsRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::orderBy('id', 'desc')->get();
        $adminPermissions= Permission::orderBy('id', 'desc')->get();
        
        $userPermissions = Permission::whereIn('name',[
            'profile_access', 
            'profile_edit'
        ])->pluck('id')->toArray();

        foreach ($roles as $role) {
            switch ($role->id) {
                case 1:
                    $role->permissions()->sync($adminPermissions);
                    break;
                case 2:
                    $role->permissions()->sync($userPermissions);
                    break;
                default:
                    break;
            }
        }
    }
}
