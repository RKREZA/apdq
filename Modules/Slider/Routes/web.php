<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('frontendmanager')->group(function () {

				// Slider
				Route::prefix('slider')->group(function () {
					Route::get('/trashes', 			    'SliderController@trashes')->name('admin.sliders.trashes');
					Route::get('/index', 			    'SliderController@index')->name('admin.sliders.index');
					Route::get('/create', 			    'SliderController@create')->name('admin.sliders.create');
					Route::post('/store', 			    'SliderController@store')->name('admin.sliders.store');
					Route::get('/edit/{id}', 		    'SliderController@edit')->name('admin.sliders.edit');
					Route::post('/update/{id}', 	    'SliderController@update')->name('admin.sliders.update');
					Route::get('/status_update', 	    'SliderController@status_update')->name('admin.sliders.status_update');
					Route::delete('/trash', 		    'SliderController@trash')->name('admin.sliders.trash');
                    Route::delete('/trash/all', 	    'SliderController@trash_all')->name('admin.sliders.trash_all');
					Route::delete('/force_destroy',     'SliderController@force_destroy')->name('admin.sliders.force_destroy');
                    Route::delete('/force_destroy/all', 'SliderController@force_destroy_all')->name('admin.sliders.force_destroy_all');
					Route::post('/restore',             'SliderController@restore')->name('admin.sliders.restore');
					Route::post('/restore/all',         'SliderController@restore_all')->name('admin.sliders.restore_all');
				});


				// Slider Category
                Route::prefix('category')->group(function () {
					Route::get('/trashes', 			    'SliderCategoryController@trashes')->name('admin.slidercategories.trashes');
					Route::get('/index', 			    'SliderCategoryController@index')->name('admin.slidercategories.index');
					Route::get('/create', 			    'SliderCategoryController@create')->name('admin.slidercategories.create');
					Route::post('/store', 			    'SliderCategoryController@store')->name('admin.slidercategories.store');
					Route::get('/edit/{id}', 		    'SliderCategoryController@edit')->name('admin.slidercategories.edit');
					Route::post('/update/{id}', 	    'SliderCategoryController@update')->name('admin.slidercategories.update');
					Route::delete('/trash', 		    'SliderCategoryController@trash')->name('admin.slidercategories.trash');
                    Route::delete('/trash/all', 	    'SliderCategoryController@trash_all')->name('admin.slidercategories.trash_all');
					Route::delete('/force_destroy',     'SliderCategoryController@force_destroy')->name('admin.slidercategories.force_destroy');
                    Route::delete('/force_destroy/all', 'SliderCategoryController@force_destroy_all')->name('admin.slidercategories.force_destroy_all');
					Route::post('/restore',             'SliderCategoryController@restore')->name('admin.slidercategories.restore');
					Route::post('/restore/all',         'SliderCategoryController@restore_all')->name('admin.slidercategories.restore_all');
					Route::get('/status_update', 	    'SliderCategoryController@status_update')->name('admin.slidercategories.status_update');
                });
            });

		});

	});
});
