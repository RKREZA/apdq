<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('admin')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('paymentgateway')->group(function () {

				// Payment Gateway
				Route::prefix('paymentgateway')->group(function () {
					Route::get('/trashes', 			    'PaymentGatewayController@trashes')->name('admin.paymentgateways.trashes');
					Route::get('/index', 			    'PaymentGatewayController@index')->name('admin.paymentgateways.index');
					Route::get('/create', 			    'PaymentGatewayController@create')->name('admin.paymentgateways.create');
					Route::post('/store', 			    'PaymentGatewayController@store')->name('admin.paymentgateways.store');
					Route::get('/edit/{id}', 		    'PaymentGatewayController@edit')->name('admin.paymentgateways.edit');
					Route::post('/update/{id}', 	    'PaymentGatewayController@update')->name('admin.paymentgateways.update');
					Route::get('/status_update', 	    'PaymentGatewayController@status_update')->name('admin.paymentgateways.status_update');
					Route::delete('/trash', 		    'PaymentGatewayController@trash')->name('admin.paymentgateways.trash');
                    Route::delete('/trash/all', 	    'PaymentGatewayController@trash_all')->name('admin.paymentgateways.trash_all');
					Route::delete('/force_destroy',     'PaymentGatewayController@force_destroy')->name('admin.paymentgateways.force_destroy');
                    Route::delete('/force_destroy/all', 'PaymentGatewayController@force_destroy_all')->name('admin.paymentgateways.force_destroy_all');
					Route::post('/restore',             'PaymentGatewayController@restore')->name('admin.paymentgateways.restore');
					Route::post('/restore/all',         'PaymentGatewayController@restore_all')->name('admin.paymentgateways.restore_all');
				});
            });

		});

	});
});
