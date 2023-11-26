<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

            // announcement
            Route::prefix('announcement')->group(function () {
                Route::get('/trashes', 			    'AnnouncementController@trashes')->name('admin.announcements.trashes');
                Route::get('/index', 			    'AnnouncementController@index')->name('admin.announcements.index');
                Route::get('/create', 			    'AnnouncementController@create')->name('admin.announcements.create');
                Route::post('/store', 			    'AnnouncementController@store')->name('admin.announcements.store');
                Route::get('/edit/{id}', 		    'AnnouncementController@edit')->name('admin.announcements.edit');
                Route::post('/update/{id}', 	    'AnnouncementController@update')->name('admin.announcements.update');
                Route::delete('/trash', 		    'AnnouncementController@trash')->name('admin.announcements.trash');
                Route::delete('/trash/all', 	    'AnnouncementController@trash_all')->name('admin.announcements.trash_all');
                Route::delete('/force_destroy',     'AnnouncementController@force_destroy')->name('admin.announcements.force_destroy');
                Route::delete('/force_destroy/all', 'AnnouncementController@force_destroy_all')->name('admin.announcements.force_destroy_all');
                Route::post('/restore',             'AnnouncementController@restore')->name('admin.announcements.restore');
                Route::post('/restore/all',         'AnnouncementController@restore_all')->name('admin.announcements.restore_all');
                Route::get('/status_update', 	    'AnnouncementController@status_update')->name('admin.announcements.status_update');
            });

        });

	});
});
