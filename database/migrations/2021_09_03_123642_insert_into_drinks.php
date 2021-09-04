<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

use App\Models\Drink;

class InsertIntoDrinks extends Migration
{
    public function up()
    {
        foreach ([
            [
                'name'            => 'Monster Ultra Sunrise',
                'description'     => 'A refreshing orange beverate that has 75mg of caffine per serving. Each can has two servings.',
                'serving_size'    => 2,
                'caffeine_content' => 75,
            ],
            [
                'name'            => 'Black Coffee',
                'description'     => 'The classic, the average 8oz. serving of black coffee has 95mg of caffine.',
                'serving_size'    => 1,
                'caffeine_content' => 95,
            ],
            [
                'name'            => 'Americano',
                'description'     => 'Sometimes you need to water it down a bit...and in comes the Americano with an average of 77mg of caffine per serving',
                'serving_size'    => 1,
                'caffeine_content' => 77,
            ],
            [
                'name'            => 'Sugar Free NOS',
                'description'     => 'Another orange delight without the sugar. It has 130mg per serving and each can has two servings',
                'serving_size'    => 2,
                'caffeine_content' => 130,
            ],
            [
                'name'            => '5 Hour Energy',
                'description'     => 'An amazing shot of get up and go! Each 2oz container has 200mg of caffine to get you going.',
                'serving_size'    => 1,
                'caffeine_content' => 200,
            ],
        ] as $drink) {
            Drink::create($drink);
        }
    }
}
