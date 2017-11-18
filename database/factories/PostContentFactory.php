<?php

use Faker\Generator as Faker;
use \App\Models\PostContent;

$factory->define(PostContent::class, function (Faker $faker) {

    return [
        'content' => $faker->realText(5000)
    ];

});
