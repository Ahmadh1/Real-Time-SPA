<?php

use App\User;
use App\Category;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
	$title = $faker->sentence(6, true);
    return [
        'title'	=>	$title,
        'slug'	=>	str_slug($title),
        'body'	=>	$faker->paragraph(2, true),
        'category_id'	=>	function() {
        	return Category::all()->random();
        },
        'user_id'	=>	function() {
        	return User::all()->random();
        }
    ];
});
