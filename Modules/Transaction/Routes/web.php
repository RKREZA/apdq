<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('admin')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('transaction')->group(function () {

				// Transaction
				Route::prefix('transaction')->group(function () {
					// Route::get('/trashes', 			    'TransactionController@trashes')->name('admin.transactions.trashes');
					Route::get('/index', 			    'TransactionController@index')->name('admin.transactions.index');
					// Route::get('/create', 			    'TransactionController@create')->name('admin.transactions.create');
					Route::post('/store', 			    'TransactionController@store')->name('admin.transactions.store');
					Route::get('/edit/{id}', 		    'TransactionController@edit')->name('admin.transactions.edit');
					Route::post('/update/{id}', 	    'TransactionController@update')->name('admin.transactions.update');
					Route::get('/status_update', 	    'TransactionController@status_update')->name('admin.transactions.status_update');
					Route::delete('/trash', 		    'TransactionController@trash')->name('admin.transactions.trash');
                    Route::delete('/trash/all', 	    'TransactionController@trash_all')->name('admin.transactions.trash_all');
					Route::delete('/force_destroy',     'TransactionController@force_destroy')->name('admin.transactions.force_destroy');
                    Route::delete('/force_destroy/all', 'TransactionController@force_destroy_all')->name('admin.transactions.force_destroy_all');
					Route::post('/restore',             'TransactionController@restore')->name('admin.transactions.restore');
					Route::post('/restore/all',         'TransactionController@restore_all')->name('admin.transactions.restore_all');
				});
            });

		});

	});
});
