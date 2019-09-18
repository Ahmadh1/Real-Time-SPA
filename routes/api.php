<?php
// Auth Routes
Route::group(['prefix' => 'auth'], function() {
    Route::post('signup', 'AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::apiResource('/question', 'QuestionController');
Route::apiResource('/question/{question}/reply', 'ReplyController');
Route::apiResource('/category', 'CategoryController');
Route::post('/like/{reply}', 'LikeController@like');
Route::delete('/like/{reply}', 'LikeController@unLike');