<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('setting')->group(function () {

				// language
                Route::prefix('language')->group(function () {
					Route::get('/trashes', 			    'LanguageController@trashes')->name('admin.setting.languages.trashes');
					Route::get('/index', 			    'LanguageController@index')->name('admin.setting.languages.index');
					Route::get('/create', 			    'LanguageController@create')->name('admin.setting.languages.create');
					Route::post('/store', 			    'LanguageController@store')->name('admin.setting.languages.store');
					Route::get('/edit/{id}', 		    'LanguageController@edit')->name('admin.setting.languages.edit');
					Route::post('/update/{id}', 	    'LanguageController@update')->name('admin.setting.languages.update');
					Route::get('/status_update', 	    'LanguageController@status_update')->name('admin.setting.languages.status_update');
					Route::get('/default_update', 	    'LanguageController@default_update')->name('admin.setting.languages.default_update');

					Route::delete('/trash', 		    'LanguageController@trash')->name('admin.setting.languages.trash');
                    Route::delete('/trash/all', 	    'LanguageController@trash_all')->name('admin.setting.languages.trash_all');
					Route::delete('/force_destroy',     'LanguageController@force_destroy')->name('admin.setting.languages.force_destroy');
                    Route::delete('/force_destroy/all', 'LanguageController@force_destroy_all')->name('admin.setting.languages.force_destroy_all');
					Route::post('/restore',             'LanguageController@restore')->name('admin.setting.languages.restore');
					Route::post('/restore/all',         'LanguageController@restore_all')->name('admin.setting.languages.restore_all');
                });
            });

		});

	});
});
