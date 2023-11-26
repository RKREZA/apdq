<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'language'],function (){
    Route::get('/', 		        'FrontEndController@home')->name('frontend.home');
    Route::get('/delete-user', 	    'FrontEndController@delete_user')->name('frontend.delete_user');
    Route::get('/privacy-policy', 	    'FrontEndController@privacy_policy')->name('frontend.privacy_policy');
    Route::get('/terms-of-services', 	    'FrontEndController@terms_of_services')->name('frontend.terms_of_services');


    // Route::get('/load-ajax_trip_header_blade', 'FrontEndController@load_ajax_trip_header_blade')->name('frontend.load_ajax_trip_header_blade');
    // Route::get('/load-ajax_trip_body_blade', 'FrontEndController@load_ajax_trip_body_blade')->name('frontend.load_ajax_trip_body_blade');
    // Route::get('/load-ajax_trip_footer_blade', 'FrontEndController@load_ajax_trip_footer_blade')->name('frontend.load_ajax_trip_footer_blade');

    // Route::get('/load_ajax_trip_after_submit_header_blade', 'FrontEndController@load_ajax_trip_after_submit_header_blade')->name('frontend.load_ajax_trip_after_submit_header_blade');
    // Route::get('/load_ajax_trip_after_submit_body_blade', 'FrontEndController@load_ajax_trip_after_submit_body_blade')->name('frontend.load_ajax_trip_after_submit_body_blade');
    // Route::get('/load_ajax_trip_after_submit_footer_blade', 'FrontEndController@load_ajax_trip_after_submit_footer_blade')->name('frontend.load_ajax_trip_after_submit_footer_blade');


    Route::get('/get_vehicle_routes_by_stoppage', 	    'FrontEndController@get_vehicle_routes_by_stoppage')->name('frontend.get_vehicle_routes_by_stoppage');

});
