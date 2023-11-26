<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('fd')->group(function () {

				// Feedback
				Route::prefix('feedback')->group(function () {
					Route::get('/trashes', 			    'FeedbackController@trashes')->name('admin.feedbacks.trashes');
					Route::get('/index', 			    'FeedbackController@index')->name('admin.feedbacks.index');
					Route::get('/view/{id}', 		    'FeedbackController@view')->name('admin.feedbacks.view');
					Route::get('/status_update', 	    'FeedbackController@status_update')->name('admin.feedbacks.status_update');
					Route::delete('/trash', 		    'FeedbackController@trash')->name('admin.feedbacks.trash');
                    Route::delete('/trash/all', 	    'FeedbackController@trash_all')->name('admin.feedbacks.trash_all');
					Route::delete('/force_destroy',     'FeedbackController@force_destroy')->name('admin.feedbacks.force_destroy');
                    Route::delete('/force_destroy/all', 'FeedbackController@force_destroy_all')->name('admin.feedbacks.force_destroy_all');
					Route::post('/restore',             'FeedbackController@restore')->name('admin.feedbacks.restore');
					Route::post('/restore/all',         'FeedbackController@restore_all')->name('admin.feedbacks.restore_all');
				});


				// Feedback Category
                Route::prefix('category')->group(function () {
					Route::get('/trashes', 			    'FeedbackCategoryController@trashes')->name('admin.feedbackcategories.trashes');
					Route::get('/index', 			    'FeedbackCategoryController@index')->name('admin.feedbackcategories.index');
					Route::get('/create', 			    'FeedbackCategoryController@create')->name('admin.feedbackcategories.create');
					Route::post('/store', 			    'FeedbackCategoryController@store')->name('admin.feedbackcategories.store');
					Route::get('/edit/{id}', 		    'FeedbackCategoryController@edit')->name('admin.feedbackcategories.edit');
					Route::post('/update/{id}', 	    'FeedbackCategoryController@update')->name('admin.feedbackcategories.update');
					Route::delete('/trash', 		    'FeedbackCategoryController@trash')->name('admin.feedbackcategories.trash');
                    Route::delete('/trash/all', 	    'FeedbackCategoryController@trash_all')->name('admin.feedbackcategories.trash_all');
					Route::delete('/force_destroy',     'FeedbackCategoryController@force_destroy')->name('admin.feedbackcategories.force_destroy');
                    Route::delete('/force_destroy/all', 'FeedbackCategoryController@force_destroy_all')->name('admin.feedbackcategories.force_destroy_all');
					Route::post('/restore',             'FeedbackCategoryController@restore')->name('admin.feedbackcategories.restore');
					Route::post('/restore/all',         'FeedbackCategoryController@restore_all')->name('admin.feedbackcategories.restore_all');
					Route::get('/status_update', 	    'FeedbackCategoryController@status_update')->name('admin.feedbackcategories.status_update');
                });
            });

		});

	});
});
