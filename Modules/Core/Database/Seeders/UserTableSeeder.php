<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin
        $this->createUserWithRole('Admin', 'admin@mail.com', '01740483311', 'abc123', 'Admin');

        // Check if 'User' role exists, create it if not
        $userRole = Role::where('name', 'User')->first();
        if (!$userRole) {
            $this->createUserRoleWithPermissions();
        }

        // Create 20 Users with Random Data and 'User' Role
        for ($i = 1; $i <= 20; $i++) {
            $this->createRandomUserWithRole("User{$i}", "user{$i}@mail.com", '017404833' . ($i + 1), 'abc123', 'User');
        }
    }

    /**
     * Create the 'User' role with the specified permissions.
     *
     * @return void
     */
    private function createUserRoleWithPermissions()
    {
        $permissions = [
            1   => 1,
            2   => 2,
            3   => 55,
            4   => 97
        ];

        $userRole = Role::create(['name' => 'User', 'guard_name' => 'web']);
        $userRole->syncPermissions($permissions);
    }

    /**
     * Create a user with the specified role.
     *
     * @param string $name
     * @param string $email
     * @param string $mobile
     * @param string $password
     * @param string $roleName
     * @return void
     */
    private function createUserWithRole($name, $email, $mobile, $password, $roleName)
    {
        $permissions = Permission::pluck('id', 'id')->all();
        $role = Role::create(['name' => $roleName, 'guard_name' => 'web']);
        $role->syncPermissions($permissions);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => bcrypt($password),
        ]);

        $user->assignRole([$role->id]);
    }

    /**
     * Create a user with random data and the specified role.
     *
     * @param string $name
     * @param string $email
     * @param string $mobile
     * @param string $password
     * @param string $roleName
     * @return void
     */
    private function createRandomUserWithRole($name, $email, $mobile, $password, $roleName)
    {
        $userRole = Role::where('name', $roleName)->first();
        if (!$userRole) {
            // If 'User' role somehow doesn't exist, create it
            $this->createUserRoleWithPermissions();
            $userRole = Role::where('name', $roleName)->first();
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => bcrypt($password),
        ]);

        $user->assignRole([$userRole->id]);
    }
}
