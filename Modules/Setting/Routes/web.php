<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;


Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {

		Route::group(['middleware' => ['auth']], function() {

            Route::prefix('setting')->group(function () {
                Route::prefix('adminsetting')->group(function () {
                    Route::get('/index', 			    'AdminSettingController@index')->name('admin.setting.adminsettings.index');

                    Route::post('/update/logolight', 	'AdminSettingController@logo_light')->name('admin.setting.adminsettings.logo_light');
                    Route::post('/update/logodark', 	'AdminSettingController@logo_dark')->name('admin.setting.adminsettings.logo_dark');
                    Route::post('/update/favicon', 	'AdminSettingController@favicon')->name('admin.setting.adminsettings.favicon');

                    Route::post('/update/siteinfo', 	'AdminSettingController@update_info')->name('admin.setting.adminsettings.update_info');

                    Route::post('/update/metaimage', 	'AdminSettingController@meta_image')->name('admin.setting.adminsettings.meta_image');
                    Route::post('/update/sitemeta', 	'AdminSettingController@update_meta')->name('admin.setting.adminsettings.update_meta');

                    Route::post('/update/preloader', 	'AdminSettingController@update_preloader')->name('admin.setting.adminsettings.update_preloader');
                    Route::post('/update/back_to_top', 	'AdminSettingController@update_back_to_top')->name('admin.setting.adminsettings.update_back_to_top');
                    Route::post('/update/copyright', 	'AdminSettingController@update_copyright')->name('admin.setting.adminsettings.update_copyright');
                    Route::post('/update/email_setting', 	'AdminSettingController@email_setting')->name('admin.setting.adminsettings.email_setting');
                    Route::post('/update/email_template', 	'AdminSettingController@email_template')->name('admin.setting.adminsettings.email_template');
                    Route::post('/update/sms_setting', 	'AdminSettingController@sms_setting')->name('admin.setting.adminsettings.sms_setting');
                    Route::post('/update/sms_template', 	'AdminSettingController@sms_template')->name('admin.setting.adminsettings.sms_template');
                    Route::post('/update/pusher_setting', 	'AdminSettingController@pusher_setting')->name('admin.setting.adminsettings.pusher_setting');
                });

                // SMS SETTING
                Route::prefix('sms')->group(function () {
                    Route::get('/index', 			        'SmsSettingController@index')->name('admin.setting.smssettings.index');
                    Route::post('/update/sms_setting', 	    'SmsSettingController@sms_setting')->name('admin.setting.smssettings.sms_setting');
                });

                // SMTP SETTING
                Route::prefix('smtp')->group(function () {
                    Route::get('/index', 			        'SmtpSettingController@index')->name('admin.setting.smtpsettings.index');
                    Route::post('/update/email_setting', 	'SmtpSettingController@email_setting')->name('admin.setting.smtpsettings.update');
                });

                // Backup
                Route::prefix('backup')->group(function () {
                    Route::get('/index', 			    'BackupController@index')->name('admin.setting.backup.index');
                    Route::get('/create', 			    'BackupController@create')->name('admin.setting.backup.create');
                    Route::get('/clean', 			    'BackupController@clean')->name('admin.setting.backup.clean');
                    Route::get('/monitor', 			    'BackupController@monitor')->name('admin.setting.backup.monitor');
                    Route::post('/delete/{name}', 		'BackupController@delete')->name('admin.setting.backup.delete');
                    Route::get('/download/{name}', 	    'BackupController@download')->name('admin.setting.backup.download');
                });

            });



		});

	});
});
