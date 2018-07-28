<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FilmsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();
        
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('123456')
        ]);
        DB::table('films')->insert([
            'name' => $faker->name,
            'slug' => strtolower(str_random(10)),
            'description' => $faker->paragraph,
            'release_date' => date("Y-m-d"),
            'rating' => rand(1, 5),
            'ticket_price' => rand(100, 200),
            'country' => 'UK'
        ]);
        DB::table('films')->insert([
            'name' => $faker->name,
            'slug' => strtolower(str_random(10)),
            'description' => $faker->paragraph,
            'release_date' => date("Y-m-d"),
            'rating' => rand(1, 5),
            'ticket_price' => rand(100, 200),
            'country' => 'UK'
        ]);
        DB::table('films')->insert([
            'name' => $faker->name,
            'slug' => strtolower(str_random(10)),
            'description' => $faker->paragraph,
            'release_date' => date("Y-m-d"),
            'rating' => rand(1, 5),
            'ticket_price' => rand(100, 200),
            'country' => 'UK'
        ]);
        DB::table('comments')->insert([
            'film_id' => 1,
            'user_id' => 1,
            'name' => $faker->name,
            'comment' => $faker->paragraph,
        ]);
        DB::table('comments')->insert([
            'film_id' => 2,
            'user_id' => 1,
            'name' => $faker->name,
            'comment' => $faker->paragraph,
        ]);
        DB::table('comments')->insert([
            'film_id' => 3,
            'user_id' => 1,
            'name' => $faker->name,
            'comment' => $faker->paragraph,
        ]);
    }

}
