<?php

$factory->define(\MichaelJennings\EloquentPaginator\Tests\Fixtures\Product::class, function(\Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->sentence,
    ];
});