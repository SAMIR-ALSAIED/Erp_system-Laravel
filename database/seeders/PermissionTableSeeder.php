<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        // مسح كاش الصلاحيات
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1️⃣ إنشاء جميع الصلاحيات
        $permissions = [
            'الفواتير',
            'قائمة الفواتير',
            'الفواتير المدفوعة',
            'الفواتير الغير مدفوعة',
            'التقارير',
            'تقرير الفواتير',
            'المستخدمين',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',
            'المنتجات',
            'الاقسام',
            'اضافة فاتورة',
            'حذف الفاتورة',
            'تصدير EXCEL',
            'تعديل الفاتورة',
            'طباعةالفاتورة',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            'اضافة منتج',
            'تعديل منتج',
            'حذف منتج',
            'اضافة قسم',
            'تعديل قسم',
            'حذف قسم',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2️⃣ إنشاء Role Admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // 3️⃣ ربط جميع الصلاحيات بالـ Role
        $adminRole->syncPermissions(Permission::all());

        // 4️⃣ إنشاء مستخدم Admin
        $admin = User::firstOrCreate(
            ['email' => 'samir@gamil.com'],
            [
                'name' => 'samir',
                'password' => Hash::make('12345678'),
                'status' => 'مفعل',
            ]
        );

        // 5️⃣ ربط المستخدم بالـ Role
        $admin->assignRole($adminRole);

        $this->command->info('Permissions, Role and Admin user created successfully!');
    }
}
