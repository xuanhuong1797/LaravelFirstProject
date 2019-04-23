<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

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
            'username' => 'minhquan',
            'password' => bcrypt('123456'),
            'gender' => 0,
        ]);
        $user->assignRole('admin');
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'username' => Str::random(10),
                'password' => bcrypt('secret'),
                'gender' => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
