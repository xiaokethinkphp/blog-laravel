<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cate;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Cate::class, function (Faker $faker) {
    $cates = Cate::all();
    $ids = $cates->modelKeys();
    return [
        'name' => $faker->name,
        'parent_id' =>  $faker->randomElement($ids)
    ];
});
