<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Hawarthipsis Concolor',
                'price' => 150000,
                'quantity' => 100,
                'description' => 'This is a very unique plant',
                'image' => 'images/1634726063.jpeg',
                'category_id' => 2
            ],
            [
                'name' => 'Peashoter',
                'price' => 85000,
                'quantity' => 250,
                'description' => 'This is a green plant',
                'image' => 'images/1634644081.jpeg',
                'category_id' => 1
            ],
            [
                'name' => 'Hawarthipsis Concolor 2',
                'price' => 150000,
                'quantity' => 100,
                'description' => 'This is a very unique plant',
                'image' => 'images/1634726063.jpeg',
                'category_id' => 2
            ],
            [
                'name' => 'Peashoter 2',
                'price' => 85000,
                'quantity' => 250,
                'description' => 'This is a green plant',
                'image' => 'images/1634644081.jpeg',
                'category_id' => 1
            ],
            [
                'name' => 'Hawarthipsis Concolor 3',
                'price' => 150000,
                'quantity' => 100,
                'description' => 'This is a very unique plant',
                'image' => 'images/1634726063.jpeg',
                'category_id' => 2
            ],
            [
                'name' => 'Peashoter 4',
                'price' => 85000,
                'quantity' => 250,
                'description' => 'This is a green plant',
                'image' => 'images/1634644081.jpeg',
                'category_id' => 1
            ],
            [
                'name' => 'Hawarthipsis Concolor 4',
                'price' => 150000,
                'quantity' => 100,
                'description' => 'This is a very unique plant',
                'image' => 'images/1634726063.jpeg',
                'category_id' => 2
            ],
            [
                'name' => 'Peashoter 5',
                'price' => 85000,
                'quantity' => 250,
                'description' => 'This is a green plant',
                'image' => 'images/1634644081.jpeg',
                'category_id' => 1
            ]
        ];
        Product::insert($products);
    }
}
