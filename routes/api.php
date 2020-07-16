<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth',
    'prefix'     => '/text-messaging',
], function () {

    Route::get('/', 'TextMessagingController@all');

    Route::post('/send', 'TextMessagingController@send');

    Route::post('/{textMessage}/refresh', 'TextMessagingController@refresh');

});
