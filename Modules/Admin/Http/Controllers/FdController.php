<?php

namespace Modules\Admin\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Feedback\Entities\Feedback;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Providers\RouteServiceProvider;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;


class FdController extends Controller
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
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }




    public function store(Request $request) {
        $rules = [
			'name' 			        => 'required|string',
			'mobile' 			    => 'required|numeric',
		    'title' 			    => 'required|string',
			'category_id' 			=> 'required|numeric',
			'description' 			=> 'required|string',
            // 'captcha'               => 'required|captcha',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'mobile.required'    	=> __('core::core.form.validation.required'),
            'title.required'    	=> __('core::core.form.validation.required'),
            'category_id.required'  => __('core::core.form.validation.required'),
            'description.required'  => __('core::core.form.validation.required'),
        ];

        Validator::make($request->all(), $rules, $messages);

		try {
			Feedback::create([
                'name'              => $request->input('name'),
                'mobile'            => $request->input('mobile'),
                'title'             => $request->input('title'),
                'category_id'       => $request->input('category_id'),
                'description'       => $request->input('description')
            ]);

			$success_msg            = __('core::core.message.success.store');
			// return redirect()->back()->with('success',$success_msg);
            return response()->json(['success'=>$success_msg], 200);

		} catch (Exception $e) {
			$error_msg              = __('core::core.message.error');
			// return redirect()->back()->with('error',$error_msg);
            return response()->json(['error'=>$error_msg]);
		}
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('math')]);
    }
}
