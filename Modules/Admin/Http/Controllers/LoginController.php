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
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
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

    public function login()
    {
        $locale = App::currentLocale();
        $settings = FrontendSetting::first();
        return view('admin::auth.login', compact('locale','settings'));
    }

    public function login_go(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required',
            'remember'              => 'nullable',
            'g-recaptcha-response'  => [new GoogleReCaptchaV3ValidationRule('login_action')]
        ];

        $messages = [
            'email.required'        => __('admin::auth.form.validation.email.required'),
            'email.email'           => __('admin::auth.form.validation.email.email'),
            'password.required'     => __('admin::auth.form.validation.password.required'),
            'g-recaptcha-response.captcha'       => __('admin::auth.form.validation.captcha.captcha'),
        ];

        // $validator = Validator::make($request->all(), $rules, $messages);
        $request->validate($rules, $messages);

        $data = $request->all();


        if (!isset(request()->remember)) {
            $data['remember'] = "off";
        }


        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember'])) {
            if (auth()->user()->status == 'Active') {
                Session::put('user_2fa', auth()->user()->id);
                if(auth()->user()->roles->pluck('two_fa')[0] == 'Active'){
                    auth()->user()->generateCode();
                    Session::forget('user_2fa');
                    return redirect()->route('admin.2fa.index');
                }else{
                    return redirect()->route('dashboard');
                }

            }else{
                // Session::forget('user_2fa');
                auth()->logout();
                $error_msg = __('admin::auth.profile.message.deactivated.error');
                return redirect()->back()->with('error', $error_msg);
            }
        }else{
            // Session::forget('user_2fa');
            auth()->logout();
            $error_msg = __('admin::auth.profile.message.password.warning');
            return redirect()->back()->with('error', $error_msg);
        }

    }

    public function logout(Request $request) {
        Auth::logout();
        // Session::forget('user_2fa');
        return redirect('admin/login');
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
