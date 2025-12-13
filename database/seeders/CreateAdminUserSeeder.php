<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء Role إذا لم يكن موجودًا
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // إنشاء المستخدم أو استرجاعه
        $admin = User::firstOrCreate(
            ['email' => 'samir@gamil.com'],
            [
                'name' => 'samir',
                'password' => Hash::make('12345678'),
                'status' => 'مفعل'
            ]
        );

        // ربط المستخدم بالـ Role
        $admin->assignRole($adminRole);

        $this->command->info('Admin user created successfully!');
    }
}
