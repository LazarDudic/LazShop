<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class, PermissionSeeder::class]);

        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        Product::factory(20)->create();
    }
}
