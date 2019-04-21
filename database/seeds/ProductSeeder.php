<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                $product = new Product();
                $product->name = $faker->text(15);
                $product->address = $faker->address();
                $product->description = $faker->text();
                $product->price = $faker->randomNumber(5);
                $product->category_id = $j;
                $product->user_id = $faker->numberBetween(1, 10);
                $product->published = $faker->boolean(50);
                $product->save();
            }
        }
    }
}
