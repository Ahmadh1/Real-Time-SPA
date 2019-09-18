<?php

use App\User;
use App\Question;
use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'body'	=>	$faker->text,
        'question_id'	=>	function() {
        	return Question::all()->random();
        },
        'user_id'	=>	function() {
        	return User::all()->random();
        }
    ];
});
