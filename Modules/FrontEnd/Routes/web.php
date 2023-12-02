<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'language'],function (){
    Route::get('/', 		                'FrontEndController@home')->name('frontend.home');
    Route::post('/newsletter', 		        'FrontEndController@newsletter')->name('frontend.newsletter');
    Route::get('/a-propos', 		        'FrontEndController@about')->name('frontend.about');

    Route::get('/video', 		            'FrontEndController@video')->name('frontend.video');
    Route::get('/video/{slug}', 		    'FrontEndController@video_single')->name('frontend.video.single');

    Route::get('/blog', 		            'FrontEndController@blog')->name('frontend.blog');
    Route::get('/blog/{slug}', 		        'FrontEndController@blog_single')->name('frontend.blog.single');


    Route::get('/live', 		            'FrontEndController@live')->name('frontend.live');

    Route::get('/contact', 		            'FrontEndController@contact')->name('frontend.contact');
    Route::post('/contact/go', 		        'FrontEndController@contact_go')->name('frontend.contact_go');

    Route::get('/donation', 		         'FrontEndController@donation')->name('frontend.donation');


    Route::get('/delete-user', 	            'FrontEndController@delete_user')->name('frontend.delete_user');
    Route::get('/privacy-policy', 	        'FrontEndController@privacy_policy')->name('frontend.privacy_policy');
    Route::get('/terms-of-services', 	    'FrontEndController@terms_of_services')->name('frontend.terms_of_services');
});
