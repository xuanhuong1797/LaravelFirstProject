<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Comment;
use App\Rating;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i<= 120; $i ++) {
            for ($j = 1;$j <= 5; $j ++) {
                $comment = new Comment();
                $rating = new Rating();
                $comment->user_id = $faker->numberBetween(1, 10);
                $rating->user_id = $comment->user_id;
                $comment->product_id = $i;
                $rating->product_id = $comment->product_id;
                $rating->value = $faker->numberBetween(1, 5);
                $comment->body = $faker->text();
                $comment->save();
                $rating->comment_id = $comment->id;
                $rating->save();
            }
        }
    }
}
