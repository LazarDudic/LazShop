<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

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
        \App\Models\Product::factory(20)->create();

        Coupon::create([
            'code' => 'ABC123',
            'type' => 'percent',
            'amount' => 30,
            'expiry_date' => now()->subMonth()
        ]);
    }
}
