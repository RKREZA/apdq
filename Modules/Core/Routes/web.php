<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('admin')->group(function () {
		// Route::group(['middleware' => ['auth']], function() {
            // files
            Route::prefix('file')->group(function () {
            Route::get('/fetch',    'FileController@fetch')->name('admin.files.fetch');
            Route::post('/store',   'FileController@store')->name('admin.files.store');
            Route::post('/delete', 	'FileController@destroy')->name('admin.files.destroy');
            });
		// });
	});
});
