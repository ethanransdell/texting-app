<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::post('/text-messaging', 'TextMessagingController@send');

});
