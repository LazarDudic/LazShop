<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'product_access',
            'product_create',
            'product_edit',
            'product_delete',
            'category_access',
            'category_create',
            'category_edit',
            'category_delete',
            'order_access',
            'order_edit',
            'coupon_access',
            'coupon_create',
            'coupon_edit',
            'coupon_delete',
            ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

    }
}
