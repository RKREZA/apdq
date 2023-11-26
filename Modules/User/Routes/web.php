<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Language;

Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {
		Route::group(['middleware' => ['auth']], function() {

			Route::prefix('um')->group(function () {
				// User

				Route::prefix('users')->group(function () {
					Route::get('/trashes', 			    'UserController@trashes')->name('admin.users.trashes');
					Route::get('/index', 			    'UserController@index')->name('admin.users.index');
					Route::get('/create', 			    'UserController@create')->name('admin.users.create');
					Route::post('/store', 			    'UserController@store')->name('admin.users.store');
					Route::get('/edit/{id}', 		    'UserController@edit')->name('admin.users.edit');
					Route::post('/update/{id}', 	    'UserController@update')->name('admin.users.update');
					Route::get('/status_update', 	    'UserController@status_update')->name('admin.users.status_update');

					Route::delete('/trash', 		    'UserController@trash')->name('admin.users.trash');
                    Route::delete('/trash/all', 	    'UserController@trash_all')->name('admin.users.trash_all');
					Route::delete('/force_destroy',     'UserController@force_destroy')->name('admin.users.force_destroy');
                    Route::delete('/force_destroy/all', 'UserController@force_destroy_all')->name('admin.users.force_destroy_all');
					Route::post('/restore',             'UserController@restore')->name('admin.users.restore');
					Route::post('/restore/all',         'UserController@restore_all')->name('admin.users.restore_all');
				});

				// Role
				Route::prefix('roles')->group(function () {
					Route::get('/trashes', 			    'RoleController@trashes')->name('admin.roles.trashes');
					Route::get('/index', 			    'RoleController@index')->name('admin.roles.index');
					Route::get('/create', 			    'RoleController@create')->name('admin.roles.create');
					Route::post('/store', 			    'RoleController@store')->name('admin.roles.store');
					Route::get('/edit/{id}', 		    'RoleController@edit')->name('admin.roles.edit');
					Route::post('/update/{id}', 	    'RoleController@update')->name('admin.roles.update');
					Route::get('/status_update', 	    'RoleController@status_update')->name('admin.roles.status_update');

					Route::delete('/trash', 		    'RoleController@trash')->name('admin.roles.trash');
                    Route::delete('/trash/all', 	    'RoleController@trash_all')->name('admin.roles.trash_all');
					Route::delete('/force_destroy',     'RoleController@force_destroy')->name('admin.roles.force_destroy');
                    Route::delete('/force_destroy/all', 'RoleController@force_destroy_all')->name('admin.roles.force_destroy_all');
					Route::post('/restore',             'RoleController@restore')->name('admin.roles.restore');
					Route::post('/restore/all',         'RoleController@restore_all')->name('admin.roles.restore_all');
				});

				// Permission
				Route::prefix('permissions')->group(function () {
					Route::get('/trashes', 			    'PermissionController@trashes')->name('admin.permissions.trashes');
					Route::get('/index', 			    'PermissionController@index')->name('admin.permissions.index');
					Route::get('/create', 			    'PermissionController@create')->name('admin.permissions.create');
					Route::post('/store', 			    'PermissionController@store')->name('admin.permissions.store');
					Route::get('/edit/{id}', 		    'PermissionController@edit')->name('admin.permissions.edit');
					Route::post('/update/{id}', 	    'PermissionController@update')->name('admin.permissions.update');

					Route::delete('/trash', 		    'PermissionController@trash')->name('admin.permissions.trash');
                    Route::delete('/trash/all', 	    'PermissionController@trash_all')->name('admin.permissions.trash_all');
					Route::delete('/force_destroy',     'PermissionController@force_destroy')->name('admin.permissions.force_destroy');
                    Route::delete('/force_destroy/all', 'PermissionController@force_destroy_all')->name('admin.permissions.force_destroy_all');
					Route::post('/restore',             'PermissionController@restore')->name('admin.permissions.restore');
					Route::post('/restore/all',         'PermissionController@restore_all')->name('admin.permissions.restore_all');
				});

				// Permission Group
                Route::prefix('permissiongroup')->group(function () {
					Route::get('/index', 			'PermissionGroupController@index')->name('admin.permissiongroups.index');
					Route::get('/create', 			'PermissionGroupController@create')->name('admin.permissiongroups.create');
					Route::post('/store', 			'PermissionGroupController@store')->name('admin.permissiongroups.store');
					Route::get('/edit/{id}', 		'PermissionGroupController@edit')->name('admin.permissiongroups.edit');
					Route::post('/update/{id}', 	'PermissionGroupController@update')->name('admin.permissiongroups.update');
					Route::delete('/destroy', 		'PermissionGroupController@destroy')->name('admin.permissiongroups.destroy');
                    Route::delete('/destroy/all', 	'PermissionGroupController@delete_all')->name('admin.permissiongroups.delete_all');
					Route::get('/status_update', 	'PermissionGroupController@status_update')->name('admin.permissiongroups.status_update');
                });

				// Department
				Route::prefix('departments')->group(function () {
					Route::get('/trashes', 			    'UserDepartmentController@trashes')->name('admin.userdepartments.trashes');
					Route::get('/index', 			    'UserDepartmentController@index')->name('admin.userdepartments.index');
					Route::get('/create', 			    'UserDepartmentController@create')->name('admin.userdepartments.create');
					Route::post('/store', 			    'UserDepartmentController@store')->name('admin.userdepartments.store');
					Route::get('/edit/{id}', 		    'UserDepartmentController@edit')->name('admin.userdepartments.edit');
					Route::post('/update/{id}', 	    'UserDepartmentController@update')->name('admin.userdepartments.update');
					Route::get('/status_update', 	    'UserDepartmentController@status_update')->name('admin.userdepartments.status_update');

					Route::delete('/trash', 		    'UserDepartmentController@trash')->name('admin.userdepartments.trash');
                    Route::delete('/trash/all', 	    'UserDepartmentController@trash_all')->name('admin.userdepartments.trash_all');
					Route::delete('/force_destroy',     'UserDepartmentController@force_destroy')->name('admin.userdepartments.force_destroy');
                    Route::delete('/force_destroy/all', 'UserDepartmentController@force_destroy_all')->name('admin.userdepartments.force_destroy_all');
					Route::post('/restore',             'UserDepartmentController@restore')->name('admin.userdepartments.restore');
					Route::post('/restore/all',         'UserDepartmentController@restore_all')->name('admin.userdepartments.restore_all');
				});

			});
		});

	});
});
