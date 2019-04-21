<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $category = new Category();
        $name = 'Đồ Ăn';
        $category->name = $name;
        $category->image_url = 'categories/'.$faker->numberBetween(1, 4).'.png';
        $category->save();

        $category = new Category();
        $name = 'Đồ Uống';
        $category->name = $name;
        $category->image_url = 'categories/'.$faker->numberBetween(1, 4).'.png';
        $category->save();

        $category = new Category();
        $name = 'Đồ dùng';
        $category->name = $name;
        $category->image_url = 'categories/'.$faker->numberBetween(1, 4).'.png';
        $category->save();

        $category = new Category();
        $name = 'Điện tử';
        $category->name = $name;
        $category->image_url = 'categories/'.$faker->numberBetween(1, 4).'.png';
        $category->save();
    }
}
