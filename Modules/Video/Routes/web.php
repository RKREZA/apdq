<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('video')->group(function () {

				// Video
				Route::prefix('video')->group(function () {
					Route::get('/trashes', 			    'VideoController@trashes')->name('admin.videos.trashes');
					Route::get('/index', 			    'VideoController@index')->name('admin.videos.index');
					Route::get('/create/youtube', 	    'VideoController@create_youtube')->name('admin.videos.youtube.create');
					Route::get('/create/manual', 	    'VideoController@create_manual')->name('admin.videos.manual.create');
					Route::post('/store', 			    'VideoController@store')->name('admin.videos.store');
					Route::get('/edit/{id}', 		    'VideoController@edit')->name('admin.videos.edit');
					Route::post('/update/{id}', 	    'VideoController@update')->name('admin.videos.update');
					Route::get('/status_update', 	    'VideoController@status_update')->name('admin.videos.status_update');
					Route::get('/featured_update', 	    'VideoController@featured_update')->name('admin.videos.featured_update');
					Route::delete('/trash', 		    'VideoController@trash')->name('admin.videos.trash');
                    Route::delete('/trash/all', 	    'VideoController@trash_all')->name('admin.videos.trash_all');
					Route::delete('/force_destroy',     'VideoController@force_destroy')->name('admin.videos.force_destroy');
                    Route::delete('/force_destroy/all', 'VideoController@force_destroy_all')->name('admin.videos.force_destroy_all');
					Route::post('/restore',             'VideoController@restore')->name('admin.videos.restore');
					Route::post('/restore/all',         'VideoController@restore_all')->name('admin.videos.restore_all');

					Route::get('/get', 					'VideoController@get')->name('admin.videos.get');


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


				// Video Subcategory
                Route::prefix('subcategory')->group(function () {
					Route::get('/trashes', 			    'VideoSubcategoryController@trashes')->name('admin.videosubcategories.trashes');
					Route::get('/index', 			    'VideoSubcategoryController@index')->name('admin.videosubcategories.index');
					Route::get('/create', 			    'VideoSubcategoryController@create')->name('admin.videosubcategories.create');
					Route::post('/store', 			    'VideoSubcategoryController@store')->name('admin.videosubcategories.store');
					Route::get('/edit/{id}', 		    'VideoSubcategoryController@edit')->name('admin.videosubcategories.edit');
					Route::post('/update/{id}', 	    'VideoSubcategoryController@update')->name('admin.videosubcategories.update');
					Route::delete('/trash', 		    'VideoSubcategoryController@trash')->name('admin.videosubcategories.trash');
                    Route::delete('/trash/all', 	    'VideoSubcategoryController@trash_all')->name('admin.videosubcategories.trash_all');
					Route::delete('/force_destroy',     'VideoSubcategoryController@force_destroy')->name('admin.videosubcategories.force_destroy');
                    Route::delete('/force_destroy/all', 'VideoSubcategoryController@force_destroy_all')->name('admin.videosubcategories.force_destroy_all');
					Route::post('/restore',             'VideoSubcategoryController@restore')->name('admin.videosubcategories.restore');
					Route::post('/restore/all',         'VideoSubcategoryController@restore_all')->name('admin.videosubcategories.restore_all');
					Route::get('/status_update', 	    'VideoSubcategoryController@status_update')->name('admin.videosubcategories.status_update');
                });


				// Video Playlist
                Route::prefix('playlist')->group(function () {
					Route::get('/trashes', 			    'VideoPlaylistController@trashes')->name('admin.videoplaylists.trashes');
					Route::get('/index', 			    'VideoPlaylistController@index')->name('admin.videoplaylists.index');
					Route::get('/create', 			    'VideoPlaylistController@create')->name('admin.videoplaylists.create');
					Route::post('/store', 			    'VideoPlaylistController@store')->name('admin.videoplaylists.store');
					Route::get('/edit/{id}', 		    'VideoPlaylistController@edit')->name('admin.videoplaylists.edit');
					Route::post('/update/{id}', 	    'VideoPlaylistController@update')->name('admin.videoplaylists.update');
					Route::delete('/trash', 		    'VideoPlaylistController@trash')->name('admin.videoplaylists.trash');
                    Route::delete('/trash/all', 	    'VideoPlaylistController@trash_all')->name('admin.videoplaylists.trash_all');
					Route::delete('/force_destroy',     'VideoPlaylistController@force_destroy')->name('admin.videoplaylists.force_destroy');
                    Route::delete('/force_destroy/all', 'VideoPlaylistController@force_destroy_all')->name('admin.videoplaylists.force_destroy_all');
					Route::post('/restore',             'VideoPlaylistController@restore')->name('admin.videoplaylists.restore');
					Route::post('/restore/all',         'VideoPlaylistController@restore_all')->name('admin.videoplaylists.restore_all');
					Route::get('/status_update', 	    'VideoPlaylistController@status_update')->name('admin.videoplaylists.status_update');
                });
            });

		});

	});
});
