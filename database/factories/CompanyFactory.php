<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name'=>$faker->unique()->name(),
        'email'=>$faker->email(),
        'website'=>$faker->url(),
    ];
});
