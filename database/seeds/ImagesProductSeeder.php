<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\ImageProduct;

class ImagesProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=1; $i <= 120; $i++) {
            for ($j=1; $j <= 4; $j++) {
                $image = new ImageProduct();
                $image->image_url = 'products/'.$faker->numberBetween(1, 10).'.jpg';
                $image->product_id = $i;
                $image->save();
            }
        }
    }
}
