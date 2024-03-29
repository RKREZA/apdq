<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('live')->group(function () {

				// Live
				Route::prefix('live')->group(function () {
					Route::get('/trashes', 			    'LiveController@trashes')->name('admin.lives.trashes');
					Route::get('/index', 			    'LiveController@index')->name('admin.lives.index');
					Route::get('/create', 			    'LiveController@create')->name('admin.lives.create');
					Route::post('/store', 			    'LiveController@store')->name('admin.lives.store');
					Route::get('/edit/{id}', 		    'LiveController@edit')->name('admin.lives.edit');
					Route::post('/update/{id}', 	    'LiveController@update')->name('admin.lives.update');
					Route::get('/status_update', 	    'LiveController@status_update')->name('admin.lives.status_update');
					Route::get('/archive_update', 	    'LiveController@archive_update')->name('admin.lives.archive_update');
					Route::delete('/trash', 		    'LiveController@trash')->name('admin.lives.trash');
                    Route::delete('/trash/all', 	    'LiveController@trash_all')->name('admin.lives.trash_all');
					Route::delete('/force_destroy',     'LiveController@force_destroy')->name('admin.lives.force_destroy');
                    Route::delete('/force_destroy/all', 'LiveController@force_destroy_all')->name('admin.lives.force_destroy_all');
					Route::post('/restore',             'LiveController@restore')->name('admin.lives.restore');
					Route::post('/restore/all',         'LiveController@restore_all')->name('admin.lives.restore_all');

					Route::get('/get', 					'LiveController@get')->name('admin.lives.get');

					Route::post('/fetch_youtube_data_from_link',         'LiveController@fetch_youtube_data_from_link')->name('admin.lives.fetch_youtube_data_from_link');
				});
            });

		});

	});
});
