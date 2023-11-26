<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('blog')->group(function () {

				// Post
				Route::prefix('post')->group(function () {
					Route::get('/trashes', 			    'PostController@trashes')->name('admin.posts.trashes');
					Route::get('/index', 			    'PostController@index')->name('admin.posts.index');
					Route::get('/create', 			    'PostController@create')->name('admin.posts.create');
					Route::post('/store', 			    'PostController@store')->name('admin.posts.store');
					Route::get('/edit/{id}', 		    'PostController@edit')->name('admin.posts.edit');
					Route::post('/update/{id}', 	    'PostController@update')->name('admin.posts.update');
					Route::get('/status_update', 	    'PostController@status_update')->name('admin.posts.status_update');
					Route::delete('/trash', 		    'PostController@trash')->name('admin.posts.trash');
                    Route::delete('/trash/all', 	    'PostController@trash_all')->name('admin.posts.trash_all');
					Route::delete('/force_destroy',     'PostController@force_destroy')->name('admin.posts.force_destroy');
                    Route::delete('/force_destroy/all', 'PostController@force_destroy_all')->name('admin.posts.force_destroy_all');
					Route::post('/restore',             'PostController@restore')->name('admin.posts.restore');
					Route::post('/restore/all',         'PostController@restore_all')->name('admin.posts.restore_all');
				});


				// Video Category
                Route::prefix('category')->group(function () {
					Route::get('/trashes', 			    'PostCategoryController@trashes')->name('admin.postcategories.trashes');
					Route::get('/index', 			    'PostCategoryController@index')->name('admin.postcategories.index');
					Route::get('/create', 			    'PostCategoryController@create')->name('admin.postcategories.create');
					Route::post('/store', 			    'PostCategoryController@store')->name('admin.postcategories.store');
					Route::get('/edit/{id}', 		    'PostCategoryController@edit')->name('admin.postcategories.edit');
					Route::post('/update/{id}', 	    'PostCategoryController@update')->name('admin.postcategories.update');
					Route::delete('/trash', 		    'PostCategoryController@trash')->name('admin.postcategories.trash');
                    Route::delete('/trash/all', 	    'PostCategoryController@trash_all')->name('admin.postcategories.trash_all');
					Route::delete('/force_destroy',     'PostCategoryController@force_destroy')->name('admin.postcategories.force_destroy');
                    Route::delete('/force_destroy/all', 'PostCategoryController@force_destroy_all')->name('admin.postcategories.force_destroy_all');
					Route::post('/restore',             'PostCategoryController@restore')->name('admin.postcategories.restore');
					Route::post('/restore/all',         'PostCategoryController@restore_all')->name('admin.postcategories.restore_all');
					Route::get('/status_update', 	    'PostCategoryController@status_update')->name('admin.postcategories.status_update');
                });
            });

		});

	});
});
