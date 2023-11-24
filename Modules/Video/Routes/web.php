<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('admin')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('video')->group(function () {

				// Video
				Route::prefix('video')->group(function () {
					Route::get('/trashes', 			    'VideoController@trashes')->name('admin.videos.trashes');
					Route::get('/index', 			    'VideoController@index')->name('admin.videos.index');
					Route::get('/create', 			    'VideoController@create')->name('admin.videos.create');
					Route::post('/store', 			    'VideoController@store')->name('admin.videos.store');
					Route::get('/edit/{id}', 		    'VideoController@edit')->name('admin.videos.edit');
					Route::post('/update/{id}', 	    'VideoController@update')->name('admin.videos.update');
					Route::get('/status_update', 	    'VideoController@status_update')->name('admin.videos.status_update');
					Route::delete('/trash', 		    'VideoController@trash')->name('admin.videos.trash');
                    Route::delete('/trash/all', 	    'VideoController@trash_all')->name('admin.videos.trash_all');
					Route::delete('/force_destroy',     'VideoController@force_destroy')->name('admin.videos.force_destroy');
                    Route::delete('/force_destroy/all', 'VideoController@force_destroy_all')->name('admin.videos.force_destroy_all');
					Route::post('/restore',             'VideoController@restore')->name('admin.videos.restore');
					Route::post('/restore/all',         'VideoController@restore_all')->name('admin.videos.restore_all');

					
					Route::post('/fetch_youtube_data_from_link',         'VideoController@fetch_youtube_data_from_link')->name('admin.videos.fetch_youtube_data_from_link');
				});


				// Video Category
                Route::prefix('category')->group(function () {
					Route::get('/trashes', 			    'VideoCategoryController@trashes')->name('admin.videocategories.trashes');
					Route::get('/index', 			    'VideoCategoryController@index')->name('admin.videocategories.index');
					Route::get('/create', 			    'VideoCategoryController@create')->name('admin.videocategories.create');
					Route::post('/store', 			    'VideoCategoryController@store')->name('admin.videocategories.store');
					Route::get('/edit/{id}', 		    'VideoCategoryController@edit')->name('admin.videocategories.edit');
					Route::post('/update/{id}', 	    'VideoCategoryController@update')->name('admin.videocategories.update');
					Route::delete('/trash', 		    'VideoCategoryController@trash')->name('admin.videocategories.trash');
                    Route::delete('/trash/all', 	    'VideoCategoryController@trash_all')->name('admin.videocategories.trash_all');
					Route::delete('/force_destroy',     'VideoCategoryController@force_destroy')->name('admin.videocategories.force_destroy');
                    Route::delete('/force_destroy/all', 'VideoCategoryController@force_destroy_all')->name('admin.videocategories.force_destroy_all');
					Route::post('/restore',             'VideoCategoryController@restore')->name('admin.videocategories.restore');
					Route::post('/restore/all',         'VideoCategoryController@restore_all')->name('admin.videocategories.restore_all');
					Route::get('/status_update', 	    'VideoCategoryController@status_update')->name('admin.videocategories.status_update');
                });
            });

		});

	});
});
