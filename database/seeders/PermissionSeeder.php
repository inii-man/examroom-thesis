<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role.list',
            'role.manage',
            'ship.list',
            'ship.manage',
            'branch.list',
            'branch.manage',
            'light_house.list',
            'light_house.manage',
            'user.list',
            'user.manage',
            'role.list',
            'role.manage',
            'config.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
