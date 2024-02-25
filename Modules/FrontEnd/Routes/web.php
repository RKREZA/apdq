<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'language'],function (){
    Route::get('/', 		                    'FrontEndController@home')->name('frontend.home');
    Route::post('/set-cookie',                  'FrontEndController@setCookie')->name('frontend.set.cookie');

    Route::post('/newsletter/general',          'FrontEndController@newsletter_general')->name('frontend.newsletter.general');
    Route::post('/newsletter/live',             'FrontEndController@newsletter_live')->name('frontend.newsletter.live');
    Route::get('/a-propos', 		            'FrontEndController@about')->name('frontend.about');

    Route::get('/video', 		                'FrontEndController@video')->name('frontend.video');
    Route::get('/video/oldest',                 'FrontEndController@video_oldest')->name('frontend.video.oldest');
    Route::get('/video/latest',                 'FrontEndController@video_latest')->name('frontend.video.latest');
    Route::get('/video/popular',                 'FrontEndController@video_popular')->name('frontend.video.popular');
    Route::get('/video/playlist',               'FrontEndController@video_playlist')->name('frontend.video.playlist');
    Route::get('/video/playlist/{id}',          'FrontEndController@video_playlist_single')->name('frontend.video.playlist.single');
    Route::get('/video/{slug}', 		        'FrontEndController@video_single')->name('frontend.video.single');
    Route::post('/video/comment/store', 		'FrontEndController@video_comment_store')->name('frontend.video.comments.store');
    Route::post('/video/react',                 'FrontEndController@react')->name('frontend.video.react');
    Route::get('/video/reactions/get',          'FrontEndController@get_reactions')->name('frontend.video.get.reactions');



    Route::get('/blog', 		                'FrontEndController@blog')->name('frontend.blog');
    Route::get('/blog/{slug}', 		            'FrontEndController@blog_single')->name('frontend.blog.single');
    Route::post('/blog/comment/store', 		    'FrontEndController@blog_comment_store')->name('frontend.blog.comments.store');

    Route::get('/search', 		                'FrontEndController@search')->name('frontend.search');

    Route::get('/live', 		                'FrontEndController@live')->name('frontend.live');
    Route::get('/live/archive', 		        'FrontEndController@live_archive')->name('frontend.live.archive');
    Route::get('/live/single/{slug}', 		    'FrontEndController@live_single')->name('frontend.live.single');
    Route::get('/live/fetch-messages',          'FrontEndController@fetch_messages')->name('frontend.live.fetch.messages');

    Route::get('/subscription', 		        'FrontEndController@subscription')->name('frontend.subscription');
    Route::get('/checkout', 		            'FrontEndController@checkout')->name('frontend.checkout');

    Route::get('/contact', 		                'FrontEndController@contact')->name('frontend.contact');
    Route::post('/contact/go', 		            'FrontEndController@contact_go')->name('frontend.contact_go');

    Route::get('/donation', 		            'FrontEndController@donation')->name('frontend.donation');
    Route::get('/page/{slug}', 		            'FrontEndController@page_single')->name('frontend.page.single');

    Route::get('/delete-user', 	                'FrontEndController@delete_user')->name('frontend.delete_user');
    Route::get('/privacy-policy', 	            'FrontEndController@privacy_policy')->name('frontend.privacy_policy');
    Route::get('/terms-of-services', 	        'FrontEndController@terms_of_services')->name('frontend.terms_of_services');

    Route::post('/payment/paypal',              'PayPalController@paypal')->name('frontend.paypal');
    Route::get('/payment/paypal/cancel',        'PayPalController@cancel')->name('frontend.paypal.cancel');
    Route::get('/payment/paypal/success',       'PayPalController@success')->name('frontend.paypal.success');

    Route::post('/payment/stripe',              'FrontEndController@stripe')->name('frontend.stripe');
    Route::post('/payment/stripe/post',         'StripeController@stripe_post')->name('frontend.stripe.post');
});
