<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Seeder;
use Faker\Factory;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('ru_RU');
        $data = [];

        for($i = 0; $i < 1000; $i++) {

            $price = $faker->numberBetween(2000, 10000);
            $title = $faker->word();

            $data[] = [
                'title' => $title,
                'price' => $price,
            ];
        }

        Items::insert($data);
    }
}
