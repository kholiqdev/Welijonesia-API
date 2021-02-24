<?php

namespace Database\Seeders;

use App\Models\{Address, Billing, Cart, Category, Comodity, ComodityDetail, User, Favorit, Order, OrderDetail, PaymentMethod, Product, ProductDetail, ProductUnit, Review, Rute, RuteDetail, Seller, Wallet};
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
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(VillageSeeder::class);

        Wallet::factory(5)->create();
        User::factory(5)->create();
        Favorit::factory(5)->create();
        Address::factory(5)->create();
        Cart::factory(5)->create();
        Category::factory(5)->create();
        Comodity::factory(5)->create();
        ComodityDetail::factory(5)->create();
        Order::factory(5)->create();
        OrderDetail::factory(5)->create();
        Billing::factory(5)->create();
        PaymentMethod::factory(5)->create();
        Cart::factory(5)->create();
        Product::factory(5)->create();
        ProductDetail::factory(5)->create();
        ProductUnit::factory(5)->create();
        Rute::factory(5)->create();
        RuteDetail::factory(100)->create();
        Seller::factory(5)->create();
        Review::factory(5)->create();
    }
}
