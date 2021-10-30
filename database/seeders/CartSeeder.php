<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = [
            [
                'user_id' => 1,
            ],
            [
                'user_id' => 2,
            ],
        ];

        Cart::insert($carts);
    }
}
