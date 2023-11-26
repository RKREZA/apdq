<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('faq')->group(function () {

				// Faq
				Route::prefix('faq')->group(function () {
					Route::get('/trashes', 			    'FaqController@trashes')->name('admin.faqs.trashes');
					Route::get('/index', 			    'FaqController@index')->name('admin.faqs.index');
					Route::get('/create', 			    'FaqController@create')->name('admin.faqs.create');
					Route::post('/store', 			    'FaqController@store')->name('admin.faqs.store');
					Route::get('/edit/{id}', 		    'FaqController@edit')->name('admin.faqs.edit');
					Route::post('/update/{id}', 	    'FaqController@update')->name('admin.faqs.update');
					Route::get('/status_update', 	    'FaqController@status_update')->name('admin.faqs.status_update');
					Route::delete('/trash', 		    'FaqController@trash')->name('admin.faqs.trash');
                    Route::delete('/trash/all', 	    'FaqController@trash_all')->name('admin.faqs.trash_all');
					Route::delete('/force_destroy',     'FaqController@force_destroy')->name('admin.faqs.force_destroy');
                    Route::delete('/force_destroy/all', 'FaqController@force_destroy_all')->name('admin.faqs.force_destroy_all');
					Route::post('/restore',             'FaqController@restore')->name('admin.faqs.restore');
					Route::post('/restore/all',         'FaqController@restore_all')->name('admin.faqs.restore_all');
				});


				// Faq Category
                Route::prefix('category')->group(function () {
					Route::get('/trashes', 			    'FaqCategoryController@trashes')->name('admin.faqcategories.trashes');
					Route::get('/index', 			    'FaqCategoryController@index')->name('admin.faqcategories.index');
					Route::get('/create', 			    'FaqCategoryController@create')->name('admin.faqcategories.create');
					Route::post('/store', 			    'FaqCategoryController@store')->name('admin.faqcategories.store');
					Route::get('/edit/{id}', 		    'FaqCategoryController@edit')->name('admin.faqcategories.edit');
					Route::post('/update/{id}', 	    'FaqCategoryController@update')->name('admin.faqcategories.update');
					Route::delete('/trash', 		    'FaqCategoryController@trash')->name('admin.faqcategories.trash');
                    Route::delete('/trash/all', 	    'FaqCategoryController@trash_all')->name('admin.faqcategories.trash_all');
					Route::delete('/force_destroy',     'FaqCategoryController@force_destroy')->name('admin.faqcategories.force_destroy');
                    Route::delete('/force_destroy/all', 'FaqCategoryController@force_destroy_all')->name('admin.faqcategories.force_destroy_all');
					Route::post('/restore',             'FaqCategoryController@restore')->name('admin.faqcategories.restore');
					Route::post('/restore/all',         'FaqCategoryController@restore_all')->name('admin.faqcategories.restore_all');
					Route::get('/status_update', 	    'FaqCategoryController@status_update')->name('admin.faqcategories.status_update');
                });
            });

		});

	});
});
