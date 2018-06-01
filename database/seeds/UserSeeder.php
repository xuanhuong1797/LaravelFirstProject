<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Khong Minh Quan',
            'email' => 'a@a.com',
            'username' =>'minhquan',
            'password' => bcrypt('123456'),
            'gender' => 0,
        ]);
        $user->assignRole('admin');
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) {
            User::create([
                'name'=>$faker->name,
                'email' => $faker->email,
                'username' => $faker->word,
                'password' => bcrypt('secret'),
                'gender' => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
