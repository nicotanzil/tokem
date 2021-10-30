<?php

namespace Database\Seeders;

use App\Models\CartProduct;
use Illuminate\Database\Seeder;

class CartProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cartProducts = [
            [
                'cart_id' => 2,
                'product_id' => 1,
                'quantity' => 4
            ],
            [
                'cart_id' => 2,
                'product_id' => 2,
                'quantity' => 6
            ],
            [
                'cart_id' => 2,
                'product_id' => 3,
                'quantity' => 2
            ],
        ];

        CartProduct::insert($cartProducts);
        
    }
}
