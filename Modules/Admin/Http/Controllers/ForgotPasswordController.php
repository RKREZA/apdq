<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;

use Modules\User\Notifications\PasswordReset as NotificationsPasswordReset;
use Modules\User\Entities\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function forgot_password(Request $request)
    {
        return view('admin::auth.forgot-password');
    }


    public function forgot_password_go(Request $request)
    {

        $rules = [
            'email'                 => 'required|email',
            'g-recaptcha-response'  => [new GoogleReCaptchaV3ValidationRule('login_action')]
        ];

        $messages = [
            'email.required'        => __('admin::auth.form.validation.email.required'),
            'email.email'           => __('admin::auth.form.validation.email.email'),
            'g-recaptcha-response.captcha'       => __('admin::auth.form.validation.captcha.captcha'),
        ];

        // $validator = Validator::make($request->all(), $rules, $messages);
        $request->validate($rules, $messages);

        $user = User::where('email', $request->email)->where('status', 'Active')->first();


        if($user){
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('admin::email.forgetPassword', ['token' => $token, 'email' => $request->email], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            $msg =  __('admin::auth.message.password_reset');
            // $msg = 'We have e-mailed your password reset link!';
            return back()->with(['success' => $msg]);
        }else{
            return back()->with(['error' => 'User not found!']);
        }

    }
}
