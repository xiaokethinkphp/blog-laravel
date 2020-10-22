<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Article::class, function (Faker $faker) {
    return [
        'title' =>  $faker->name,
        'user_id'   =>  1,
        'cate_id'   =>  $faker->randomElement($array = array (1,2,3,4,5)),
        'contents'  =>$faker->realText()
    ];
});
