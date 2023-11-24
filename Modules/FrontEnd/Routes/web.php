<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'language'],function (){
    Route::get('/', 		        'FrontEndController@home')->name('frontend.home');
    Route::get('/set_city', 	    'FrontEndController@set_city')->name('frontend.set_city');
    Route::get('/get_routes', 	    'FrontEndController@get_routes')->name('frontend.get_routes');
    Route::get('/get_route_by_id', 	    'FrontEndController@get_route_by_id')->name('frontend.get_route_by_id');


    // Route::get('/load-ajax_trip_header_blade', 'FrontEndController@load_ajax_trip_header_blade')->name('frontend.load_ajax_trip_header_blade');
    // Route::get('/load-ajax_trip_body_blade', 'FrontEndController@load_ajax_trip_body_blade')->name('frontend.load_ajax_trip_body_blade');
    // Route::get('/load-ajax_trip_footer_blade', 'FrontEndController@load_ajax_trip_footer_blade')->name('frontend.load_ajax_trip_footer_blade');

    // Route::get('/load_ajax_trip_after_submit_header_blade', 'FrontEndController@load_ajax_trip_after_submit_header_blade')->name('frontend.load_ajax_trip_after_submit_header_blade');
    // Route::get('/load_ajax_trip_after_submit_body_blade', 'FrontEndController@load_ajax_trip_after_submit_body_blade')->name('frontend.load_ajax_trip_after_submit_body_blade');
    // Route::get('/load_ajax_trip_after_submit_footer_blade', 'FrontEndController@load_ajax_trip_after_submit_footer_blade')->name('frontend.load_ajax_trip_after_submit_footer_blade');


    Route::get('/get_vehicle_routes_by_stoppage', 	    'FrontEndController@get_vehicle_routes_by_stoppage')->name('frontend.get_vehicle_routes_by_stoppage');

});
