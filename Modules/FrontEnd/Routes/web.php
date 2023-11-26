<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'language'],function (){
    Route::get('/', 		        'FrontEndController@home')->name('frontend.home');
    Route::get('/delete-user', 	    'FrontEndController@delete_user')->name('frontend.delete_user');
    Route::get('/privacy-policy', 	    'FrontEndController@privacy_policy')->name('frontend.privacy_policy');
    Route::get('/terms-of-services', 	    'FrontEndController@terms_of_services')->name('frontend.terms_of_services');
});
