<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $roleAdmin= Role::create(['name' => 'Super Admin']);
        $roleAgent= Role::create(['name' => 'Agent']);
        $roleStaff= Role::create(['name' => 'Staff']);
        $roleStudent= Role::create(['name' => 'Student']);
    }
}
