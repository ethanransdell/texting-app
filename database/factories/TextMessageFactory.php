<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\TextMessage;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(TextMessage::class, function (Faker $faker) {
    return [
        'message_id'   => Str::random(),
        'to'           => $faker->regexify('[0-9]{10}'),
        'from'         => $faker->regexify('[0-9]{10}'),
        'body'         => $faker->sentence,
        'service_name' => $faker->word,
        'status'       => $faker->word,
    ];
});
