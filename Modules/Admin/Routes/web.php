<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

Route::get('setlocale/{locale}',function($lang){
	Session::put('locale',$lang);
	return redirect()->back();
})->name('setlocale');

Route::get('setphase/{phase}',function($id){
	// \Session::put('phase',$id);
	session()->put('phase',$id);
	return redirect()->back();
})->name('setphase');

// Route::get('/setlocale/{locale}', 		[LanguageController::class, 'setlocale'])->name('setlocale');


Route::post('verify/captcha', function (\Illuminate\Http\Request $request) {

    $rule = [
        'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('login_action')]
    ];

    $validator = \Illuminate\Support\Facades\Validator::make($request->toArray(),$rule)->errors();
});

		
Route::get('auth/facebook', 		'LoginController@facebookRedirect')->name('auth.users.facebook');
Route::get('auth/facebook/callback', 'LoginController@loginWithFacebook')->name('auth.users.facebook.callback');


Route::group(['middleware'=>'language'],function (){
	Route::prefix('auth')->group(function () {
		// Auth
		Route::get('/login', 		    'LoginController@login')->name('admin.login');
		Route::post('/login', 	        'LoginController@login_go')->name('admin.login.go');
		Route::get('/logout', 		    'LoginController@logout')->name('admin.logout');
		Route::get('/forgot-password', 	'ForgotPasswordController@forgot_password')->middleware('guest')->name('admin.password.request');
		Route::post('/forgot-password', 'ForgotPasswordController@forgot_password_go')->middleware('guest')->name('admin.password.email');



        Route::get('/reset-password/{token}/{email}', function ($token) {
				return view('admin::auth.reset-password', ['token' => $token]);
			})->middleware('guest')->name('password.reset');

		Route::post('/reset-password', function (Request $request) {
				$request->validate([
					'token' 	=> 'required',
					'email' 	=> 'required|email',
					'password' 	=> 'required|min:6|confirmed',
				]);

                $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

                if(!$updatePassword){
                    return back()->withInput()->with('error', 'Invalid token!');
                }

                $user = User::where('email', $request->email)
                            ->update(['password' => Hash::make($request->password)]);

                DB::table('password_resets')->where(['email'=> $request->email])->delete();
                $success_msg        = __('admin::auth.message.cheng_pass');
                return redirect('/admin/login')->with('success' ,$success_msg);

			})->middleware('guest')->name('admin.password.update');


		Route::group(['middleware' => ['auth']], function() {
            Route::get('2fa',               'TwoFAController@index')->name('admin.2fa.index');
            Route::post('2fa',              'TwoFAController@store')->name('admin.2fa.post');
            Route::get('2fa/reset',         'TwoFAController@resend')->name('admin.2fa.resend');
        });

		Route::group(['middleware' => ['auth']], function() {

			Route::get('/set_sidebar', function () {
			    if (session('sidebar') == 'pin') {
			    	session(['sidebar' => 'unpin']);
			    }else{
			    	session(['sidebar' => 'pin']);
			    }
			    return session('sidebar');
			});

			Route::get('/set_mode', function () {
			    if (session('mode') == 'dark') {
			    	session(['mode' => 'light']);
			    }else{
			    	session(['mode' => 'dark']);
			    }

			    return session('mode');
			});

			// Dashboard
			Route::get('/dashboard', 	'DashboardController@dashboard')->name('dashboard');

			// Profile
			Route::prefix('profile')->group(function () {
				Route::get('/', 				'AdminController@profile')->name('admin.profile');
				Route::post('/photo/update/', 	'AdminController@update_profile_photo')->name('admin.profile.photo.update');
				Route::post('/password/update', 'AdminController@update_password')->name('admin.profile.password.update');
				Route::post('/signature/update/', 'AdminController@update_signature_photo')->name('admin.profile.signature.update');

				Route::post('/change/name', 	'AdminController@update_profile_name')->name('admin.profile.name.update');

				Route::post('/change/mobile', 	'AdminController@update_profile_mobile')->name('admin.profile.mobile.update');
			});


        });

        Route::get('refresh_captcha', 'FdController@refreshCaptcha')->name('refresh_captcha');

		//feedback store
		Route::post('/fd-store', 	'FdController@store')->name('admin.fd.store');
		Route::get('/setting/media/index', 'AdminController@media_manager')->name('admin.media.index');

		Route::get('/artisan-optimize', function() {
			Artisan::call('optimize');
            return response()->json(['success'=>'Optimized successfully.']);
		})->name('admin.artisan.optimize');

	});
});
