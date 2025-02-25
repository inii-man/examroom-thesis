<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password')
        ]);
        $role = Role::firstOrCreate(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::firstOrCreate([
            'email' => 'farras.ft@gmail.com',
        ], [
            'name' => 'Farras Fadhila',
            'password' => bcrypt('password')
        ]);
        $role = Role::firstOrCreate(['name' => 'User']);
        $permissions = Permission::where('name', 'like', '%list')->pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

    }
}
