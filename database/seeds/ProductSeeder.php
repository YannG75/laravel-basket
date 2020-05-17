<?php

use Illuminate\Database\Seeder;
use App\Product;
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
        $min = 80;
        $max = 170;
         $faker = Faker::create('fr_FR');
         $Faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $post = new Product();
            $post->name = $Faker->streetName;
            $post->description = $faker->realText(300);
            $post->price = $faker->numberBetween($min, $max);
            $post->release_date = $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');
            $post->image = 'https://picsum.photos/200/300?random='.rand(1,500);
            $post->save();
        }
    }
}
