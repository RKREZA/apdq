<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

            // Notification
            Route::prefix('notification')->group(function () {
                Route::get('/index', 			'NotificationController@index')->name('admin.notifications.index');
                Route::get('/mark_as_read', 			'NotificationController@mark_as_read')->name('admin.notifications.mark_as_read');
            });
			
		});
			
	});
});