<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Category;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            CurrencySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            PriceSeeder::class,
            CartItemSeeder::class,
        ]);
    }
}
