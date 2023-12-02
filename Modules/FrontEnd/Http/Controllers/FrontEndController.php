<?php

namespace Modules\FrontEnd\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Address\Entities\Union;
use Modules\Upload\Entities\Upload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Modules\FrontEndManager\Entities\FrontendSetting;
use Modules\Video\Entities\VideoCategory;
use Modules\Video\Entities\Video;
use Modules\Blog\Entities\PostCategory;
use Modules\Blog\Entities\Post;
use Modules\Live\Entities\Live;
use Modules\Newsletter\Entities\Newsletter;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class FrontEndController extends Controller
{
    public function home()
    {
        $frontend_setting   = FrontendSetting::first();
        $video_categories   = VideoCategory::where('status','Active')->get();
        $videos             = Video::where('status','Active')->get();
        $posts              = Post::where('status','Active')->get();

        return view('frontend::frontend.home', compact('frontend_setting','video_categories','videos','posts'));
    }

    public function about()
    {
        $frontend_setting   = FrontendSetting::first();
        return view('frontend::frontend.about', compact('frontend_setting'));
    }

    public function video()
    {
        $frontend_setting   = FrontendSetting::first();
        $video_categories    = VideoCategory::where('status','Active')->get();
        if(isset(request()->cat_id) && !empty(request()->cat_id)){
            $videos              = Video::where('status','Active')
                                        ->whereHas('category', function ($query) {
                                            $query->where('id', request()->cat_id);
                                        })
                                        ->paginate(20);
        }else{
            $videos              = Video::where('status','Active')->paginate(20);
        }

        return view('frontend::frontend.video', compact('frontend_setting','video_categories','videos'));
    }

    public function blog()
    {
        $frontend_setting   = FrontendSetting::first();
        $post_categories    = PostCategory::where('status','Active')->get();
        if(isset(request()->cat_id) && !empty(request()->cat_id)){
            $posts              = Post::where('status','Active')
                                        ->whereHas('category', function ($query) {
                                            $query->where('id', request()->cat_id);
                                        })
                                        ->paginate(20);
        }else{
            $posts              = Post::where('status','Active')->paginate(20);
        }

        return view('frontend::frontend.blog', compact('frontend_setting','post_categories','posts'));
    }

    public function live()
    {
        $frontend_setting   = FrontendSetting::first();
        $live               = Live::where('status','Active')->first();

        return view('frontend::frontend.live', compact('frontend_setting','live'));
    }

    public function contact()
    {
        $frontend_setting   = FrontendSetting::first();
        return view('frontend::frontend.contact', compact('frontend_setting'));
    }

    public function contact_go(Request $request)
    {
        $rules = [
			'name' 			            => 'required',
			'email' 			        => 'required',
			'mobile' 			        => 'required',
			'message' 			        => 'required',
        ];

        $messages = [
            'name.required'    		    => __('core::core.form.validation.required'),
            'email.required'    		=> __('core::core.form.validation.required'),
            'mobile.required'    		=> __('core::core.form.validation.required'),
            'message.required'    		=> __('core::core.form.validation.required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message
        ];

        try {

            Mail::to('info@actualitepolitiqueduquebec.com')->send(new SendMail($data));

			$success_msg            = __('core::core.message.success.sent');
            return response()->json(['success'=>$success_msg], 200);

		} catch (Exception $e) {
			$error_msg              = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
		}
    }

    public function doantion()
    {
        $frontend_setting   = FrontendSetting::first();
        return view('frontend::frontend.doantion', compact('frontend_setting'));
    }



    public function newsletter(Request $request) {
        $rules = [
			'email' 			        => 'required|email|unique:newsletters,email',
        ];

        $messages = [
            'email.required'    		=> __('core::core.form.validation.required'),
            'email.unique'    		    => __('core::core.form.validation.unique'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

		try {
			Newsletter::create([
                'email'              => $request->input('email')
            ]);

			$success_msg            = __('core::core.message.success.subscribe');
            return response()->json(['success'=>$success_msg], 200);

		} catch (Exception $e) {
			$error_msg              = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
		}
    }








    public function delete_user()
    {
        $frontend_setting   = FrontendSetting::first();
        return view('frontend::frontend.home', compact('frontend_setting'));
    }
    public function privacy_policy()
    {
        $frontend_setting   = FrontendSetting::first();
        return view('frontend::frontend.home', compact('frontend_setting'));
    }
    public function terms_of_services()
    {
        $frontend_setting   = FrontendSetting::first();
        return view('frontend::frontend.home', compact('frontend_setting'));
    }

}
