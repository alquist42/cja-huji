<?php

use App\User;

use Faker\Generator;

use App\Models\Origin;
use App\Models\Subject;
use App\Models\Image;
use App\Models\Item;

$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Item::class, function (Generator $faker) {
    return [
        'external_id' => $faker->word,
        'name' => $faker->name,
        'category' => $faker->word,
        'description' => $faker->sentence,
        'lat' => rand(1, 10),
        'lon' => rand(1, 10),
        'order'  => rand(1, 10)
    ];
});

$factory->define(Image::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'order'  => rand(1, 10),
        'original' => $faker->imageUrl(),
        'big' => $faker->imageUrl(),
        'medium'  => $faker->imageUrl(),
        'small' => $faker->imageUrl(),
        'publish_state' => rand(1, 2),
        'category' => $faker->word,
        'copyright'  => $faker->word,
        'item_id' => rand(1, 10)
    ];
});

$factory->define(Origin::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'order'  => rand(1, 10)
    ];
});

$factory->define(Subject::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'order'  => rand(1, 10)
    ];
});
