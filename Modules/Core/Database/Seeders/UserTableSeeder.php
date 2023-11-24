<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\User\Entities\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\User\Entities\UserDepartment;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions        = Permission::pluck('id','id')->all();
        $role               = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $role->syncPermissions($permissions);

        $user               = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@mail.com',
            'mobile'        => '01740483311',
            'password'      => bcrypt('abc123'),
        ]);
        $user->assignRole([$role->id]);

    }
}

