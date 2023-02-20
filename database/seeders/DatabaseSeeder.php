<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Roles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roleModel = new Roles();

        $roleModel->fill([
            'name' => 'Quản trị hệ thống',
            'code' => 'SUPER_ADMIN',
            'description' => 'Toàn quyền trên hệ thống',
        ]);

        $roleModel->save();

        $userModel = new User();

        $userModel->fill([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin123'),
            'role_code' => 'SUPER_ADMIN'
        ]);

        $userModel->save();
    }
}
