<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->PermissionCreate('view-users');
        $this->PermissionCreate('create-users');
        $this->PermissionCreate('edit-users');
        $this->PermissionCreate('delete-users');

        $this->RoleCreate('Admin',['view-users','create-users','edit-users','delete-users']);

        $this->UserCreate('Rastler','rastler89@gmail.com','password','Admin');
    }

    private function PermissionCreate($name) {
        if(Permission::where('name','=',$name)->count() == 0) {
            Permission::create(['name' => $name]);
        }
    }

    private function RoleCreate($name,$permissions) {
        if(Role::where('name','=',$name)->count() == 0) {
            $role = Role::create(['name' => $name]);
        } else {
            $role = Role::where('name','=',$name)->first();
        }
        if($permissions != null) {
            $role->givePermissionTo($permissions);
        }
    }

    private function UserCreate($name,$email,$password,$role) {
        if (User::where('email', '=', $email)->count() == 0) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
        } else {
            $user = User::where('email','=',$email)->first();
        }
        if($role != null) {
            $user->assignRole($role);
        }
    }
}
