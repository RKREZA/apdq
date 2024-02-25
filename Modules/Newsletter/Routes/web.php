<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

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


				// Newsletter Category
                Route::prefix('category')->group(function () {
					Route::get('/trashes', 			    'NewsletterCategoryController@trashes')->name('admin.newslettercategories.trashes');
					Route::get('/index', 			    'NewsletterCategoryController@index')->name('admin.newslettercategories.index');
					Route::get('/create', 			    'NewsletterCategoryController@create')->name('admin.newslettercategories.create');
					Route::post('/store', 			    'NewsletterCategoryController@store')->name('admin.newslettercategories.store');
					Route::get('/edit/{id}', 		    'NewsletterCategoryController@edit')->name('admin.newslettercategories.edit');
					Route::post('/update/{id}', 	    'NewsletterCategoryController@update')->name('admin.newslettercategories.update');
					Route::delete('/trash', 		    'NewsletterCategoryController@trash')->name('admin.newslettercategories.trash');
                    Route::delete('/trash/all', 	    'NewsletterCategoryController@trash_all')->name('admin.newslettercategories.trash_all');
					Route::delete('/force_destroy',     'NewsletterCategoryController@force_destroy')->name('admin.newslettercategories.force_destroy');
                    Route::delete('/force_destroy/all', 'NewsletterCategoryController@force_destroy_all')->name('admin.newslettercategories.force_destroy_all');
					Route::post('/restore',             'NewsletterCategoryController@restore')->name('admin.newslettercategories.restore');
					Route::post('/restore/all',         'NewsletterCategoryController@restore_all')->name('admin.newslettercategories.restore_all');
					Route::get('/status_update', 	    'NewsletterCategoryController@status_update')->name('admin.newslettercategories.status_update');
                });
            });

		});

	});
});
