<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('admin')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('newsletter')->group(function () {

				// Newsletter
				Route::prefix('newsletter')->group(function () {
					Route::get('/trashes', 			    'NewsletterController@trashes')->name('admin.newsletters.trashes');
					Route::get('/index', 			    'NewsletterController@index')->name('admin.newsletters.index');
					Route::get('/create', 			    'NewsletterController@create')->name('admin.newsletters.create');
					Route::post('/store', 			    'NewsletterController@store')->name('admin.newsletters.store');
					Route::get('/edit/{id}', 		    'NewsletterController@edit')->name('admin.newsletters.edit');
					Route::post('/update/{id}', 	    'NewsletterController@update')->name('admin.newsletters.update');
					Route::get('/status_update', 	    'NewsletterController@status_update')->name('admin.newsletters.status_update');
					Route::delete('/trash', 		    'NewsletterController@trash')->name('admin.newsletters.trash');
                    Route::delete('/trash/all', 	    'NewsletterController@trash_all')->name('admin.newsletters.trash_all');
					Route::delete('/force_destroy',     'NewsletterController@force_destroy')->name('admin.newsletters.force_destroy');
                    Route::delete('/force_destroy/all', 'NewsletterController@force_destroy_all')->name('admin.newsletters.force_destroy_all');
					Route::post('/restore',             'NewsletterController@restore')->name('admin.newsletters.restore');
					Route::post('/restore/all',         'NewsletterController@restore_all')->name('admin.newsletters.restore_all');
				});
            });

		});

	});
});
