<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('cms')->group(function () {

				// Page
				Route::prefix('page')->group(function () {
					Route::get('/trashes', 			    'PageController@trashes')->name('admin.pages.trashes');
					Route::get('/index', 			    'PageController@index')->name('admin.pages.index');
					Route::get('/create', 			    'PageController@create')->name('admin.pages.create');
					Route::post('/store', 			    'PageController@store')->name('admin.pages.store');
					Route::get('/edit/{id}', 		    'PageController@edit')->name('admin.pages.edit');
					Route::post('/update/{id}', 	    'PageController@update')->name('admin.pages.update');
					Route::get('/status_update', 	    'PageController@status_update')->name('admin.pages.status_update');
					Route::delete('/trash', 		    'PageController@trash')->name('admin.pages.trash');
                    Route::delete('/trash/all', 	    'PageController@trash_all')->name('admin.pages.trash_all');
					Route::delete('/force_destroy',     'PageController@force_destroy')->name('admin.pages.force_destroy');
                    Route::delete('/force_destroy/all', 'PageController@force_destroy_all')->name('admin.pages.force_destroy_all');
					Route::post('/restore',             'PageController@restore')->name('admin.pages.restore');
					Route::post('/restore/all',         'PageController@restore_all')->name('admin.pages.restore_all');
				});


				// Video Category
                Route::prefix('category')->group(function () {
					Route::get('/trashes', 			    'PageCategoryController@trashes')->name('admin.pagecategories.trashes');
					Route::get('/index', 			    'PageCategoryController@index')->name('admin.pagecategories.index');
					Route::get('/create', 			    'PageCategoryController@create')->name('admin.pagecategories.create');
					Route::post('/store', 			    'PageCategoryController@store')->name('admin.pagecategories.store');
					Route::get('/edit/{id}', 		    'PageCategoryController@edit')->name('admin.pagecategories.edit');
					Route::post('/update/{id}', 	    'PageCategoryController@update')->name('admin.pagecategories.update');
					Route::delete('/trash', 		    'PageCategoryController@trash')->name('admin.pagecategories.trash');
                    Route::delete('/trash/all', 	    'PageCategoryController@trash_all')->name('admin.pagecategories.trash_all');
					Route::delete('/force_destroy',     'PageCategoryController@force_destroy')->name('admin.pagecategories.force_destroy');
                    Route::delete('/force_destroy/all', 'PageCategoryController@force_destroy_all')->name('admin.pagecategories.force_destroy_all');
					Route::post('/restore',             'PageCategoryController@restore')->name('admin.pagecategories.restore');
					Route::post('/restore/all',         'PageCategoryController@restore_all')->name('admin.pagecategories.restore_all');
					Route::get('/status_update', 	    'PageCategoryController@status_update')->name('admin.pagecategories.status_update');
                });
            });

		});

	});
});
