<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
use App\Models\Ward;
use Illuminate\Support\Arr;

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
        $wards = Ward::inRandomOrder()->limit(50)->get();

        for ($i = 0; $i < 30; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                $product = new Product();
                $product->name = $faker->text(15);
                $product->description = $faker->text();
                $product->price = $faker->randomNumber(5);
                $product->category_id = $j;
                $product->user_id = $faker->numberBetween(1, 10);
                $product->published = $faker->boolean(50);
                $product->save();

                $product->address()->create([
                    'ward_id' => Arr::first($wards->random(1))->id,
                    'address' => $faker->streetName(),
                ]);
            }
        }
    }
}
