<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Succulent'],
            ['name' => 'Philodendron'],
            ['name' => 'Peperomia']
        ];

        Category::insert($categories);
    }
}
