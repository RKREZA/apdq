<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('subscription')->group(function () {

				// Subscription
				Route::prefix('subscription')->group(function () {
					Route::get('/trashes', 			    'SubscriptionController@trashes')->name('admin.subscriptions.trashes');
					Route::get('/index', 			    'SubscriptionController@index')->name('admin.subscriptions.index');
					Route::get('/create', 			    'SubscriptionController@create')->name('admin.subscriptions.create');
					Route::post('/store', 			    'SubscriptionController@store')->name('admin.subscriptions.store');
					Route::get('/edit/{id}', 		    'SubscriptionController@edit')->name('admin.subscriptions.edit');
					Route::post('/update/{id}', 	    'SubscriptionController@update')->name('admin.subscriptions.update');
					Route::get('/status_update', 	    'SubscriptionController@status_update')->name('admin.subscriptions.status_update');
					Route::delete('/trash', 		    'SubscriptionController@trash')->name('admin.subscriptions.trash');
                    Route::delete('/trash/all', 	    'SubscriptionController@trash_all')->name('admin.subscriptions.trash_all');
					Route::delete('/force_destroy',     'SubscriptionController@force_destroy')->name('admin.subscriptions.force_destroy');
                    Route::delete('/force_destroy/all', 'SubscriptionController@force_destroy_all')->name('admin.subscriptions.force_destroy_all');
					Route::post('/restore',             'SubscriptionController@restore')->name('admin.subscriptions.restore');
					Route::post('/restore/all',         'SubscriptionController@restore_all')->name('admin.subscriptions.restore_all');
				});
            });

		});

	});
});
