<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
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

        User::truncate();
        Products::truncate();
        Orders::truncate();

        \App\Models\Products::factory(10)->create();



    }
}
