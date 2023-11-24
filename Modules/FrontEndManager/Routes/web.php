<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('admin')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

            Route::prefix('frontendmanager')->group(function () {
                // FrontEnd Setting
                Route::prefix('frontendsetting')->group(function () {
                    Route::get('/index', 			    'FrontendSettingController@index')->name('admin.frontendmanager.frontendsettings.index');

                    Route::post('/update/logolight', 	'FrontendSettingController@logo_light')->name('admin.frontendmanager.frontendsettings.logo_light');
                    Route::post('/update/logodark', 	'FrontendSettingController@logo_dark')->name('admin.frontendmanager.frontendsettings.logo_dark');
                    Route::post('/update/favicon', 	'FrontendSettingController@favicon')->name('admin.frontendmanager.frontendsettings.favicon');

                    Route::post('/update/siteinfo', 	'FrontendSettingController@update_info')->name('admin.frontendmanager.frontendsettings.update_info');
                    Route::post('/update/metaimage', 	'FrontendSettingController@meta_image')->name('admin.frontendmanager.frontendsettings.meta_image');

                    Route::post('/update/sitemeta', 	'FrontendSettingController@update_meta')->name('admin.frontendmanager.frontendsettings.update_meta');

                    Route::post('/update/preloader', 	'FrontendSettingController@update_preloader')->name('admin.frontendmanager.frontendsettings.update_preloader');
                    Route::post('/update/sociallink', 	'FrontendSettingController@sociallink')->name('admin.frontendmanager.frontendsettings.sociallink');

                    Route::post('/update/applink', 	'FrontendSettingController@applink')->name('admin.frontendmanager.frontendsettings.applink');

                    Route::post('/update/helpdesk', 	'FrontendSettingController@helpdesk')->name('admin.frontendmanager.frontendsettings.helpdesk');
                    Route::post('/update/address', 	'FrontendSettingController@address')->name('admin.frontendmanager.frontendsettings.address');

                    Route::post('/update/copyright', 	'FrontendSettingController@update_copyright')->name('admin.frontendmanager.frontendsettings.update_copyright');
                });
            });
		});
	});
});
