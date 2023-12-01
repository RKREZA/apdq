<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Session;
use Modules\FrontEndManager\Entities\FrontendSetting;
use Modules\Setting\Entities\Setting;
use Modules\Cms\Entities\Page;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;
use Socialite;
use DB;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class SignupController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Signup Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function signup()
    {
        $locale = App::currentLocale();
        $settings = FrontendSetting::first();
        $page = Page::where('slug','termes-et-conditions')->first();
        return view('admin::auth.signup', compact('locale','settings','page'));
    }

    public function signup_go(Request $request)
    {
        $rules = [
            'name'                  => 'required',
            'mobile'                => 'required|unique:users,mobile',
            'email'                 => 'required|email|unique:users,email',
			'password' 		        => 'required|same:password_confirmation',
            'remember'              => 'nullable',
            'g-recaptcha-response'  => [new GoogleReCaptchaV3ValidationRule('login_action')]
        ];

        $messages = [
            'name.required'                 => __('admin::auth.form.validation.name.required'),
            'mobile.required'               => __('admin::auth.form.validation.mobile.required'),
            'mobile.unique'                 => __('admin::auth.form.validation.mobile.unique'),
            'email.required'                => __('admin::auth.form.validation.email.required'),
            'email.email'                   => __('admin::auth.form.validation.email.email'),
            'email.unique'                  => __('admin::auth.form.validation.email.unique'),
            'password.required'             => __('admin::auth.form.validation.password.required'),
            'password.same'    		        => __('core::core.form.validation.same'),
            'g-recaptcha-response.captcha'  => __('admin::auth.form.validation.captcha.captcha'),
        ];

        $request->validate($rules, $messages);

        $data = $request->all();

        $role = [
            0 => "User"
        ];

        DB::beginTransaction();
		try {
            $input              = request()->all();
            $input['password']  = Hash::make($input['password']);
			$user               = User::create($input);
			$user->assignRole($role);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg          = __('core::core.message.error');
			return redirect()->route('admin.signup')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg        = __('admin::auth.message.signup_success');
        return redirect()->route('admin.login')->with('success',$success_msg);

    }










    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect('/dashboard');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }





}
