<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Transaction;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'amount'  => $faker->numberBetween(0, 10000),
        'type'    => Arr::random(Transaction::AVAILABLE_TYPES),
        'user_id' => User::orderBy(DB::raw('RAND()'))->first(),
        'date'    => $faker->dateTimeBetween('-10 years', 'now'),
    ];
});
