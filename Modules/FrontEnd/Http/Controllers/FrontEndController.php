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
use Modules\Video\Entities\VideoComment;
use Modules\Blog\Entities\PostCategory;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostComment;
use Modules\Cms\Entities\PageCategory;
use Modules\Cms\Entities\Page;
use Modules\Live\Entities\Live;
// use Modules\Slider\Entities\Slider;
use Modules\Subscription\Entities\Subscription;
use Modules\PaymentGateway\Entities\PaymentGateway;
use Modules\Newsletter\Entities\Newsletter;
use Illuminate\Support\Facades\Validator;
use App\Mail\Http\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class FrontEndController extends Controller
{
    function __construct()
	{
        $frontend_setting   = FrontendSetting::first();
        $this->yearsMonths = $this->getYearsMonths();
        View::share('yearsMonths', $this->yearsMonths);
	}

    private function getYearsMonths()
    {
        $videos = Video::selectRaw('YEAR(created_at) as year, MONTHNAME(created_at) as month')
            ->groupBy('year', 'month')
            ->orderBy('created_at', 'desc')
            ->get();

        $yearsMonths = [];

        foreach ($videos as $video) {
            $year = $video->year;
            $month = $video->month;

            if (!isset($yearsMonths[$year])) {
                $yearsMonths[$year] = [];
            }

            $yearsMonths[$year][] = $month;
        }

        return $yearsMonths;
    }

    public function home()
    {
        $frontend_setting   = FrontendSetting::first();
        $video_categories   = VideoCategory::where('status','Active')->get();
        $videos             = Video::where('status','Active')->get();
        $posts              = Post::where('status','Active')->get();
        $live               = Live::where('status','Active')->first();
        // $sliders            = Slider::where('status','Active')->get();

        return view('frontend::frontend.home', compact('frontend_setting','video_categories','videos','posts','live'));
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
        if (request()->has('year') && request()->has('month')) {
            $year = request()->input('year');
            $month = request()->input('month');

            $videos = Video::where('status', 'Active')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', Carbon::parse($month)->format('m'))
                ->paginate(21);
        } elseif (request()->has('code') && !empty(request()->code)) {
            $videos = Video::where('status', 'Active')
                ->whereHas('category', function ($query) {
                    $query->where('code', request()->code);
                })
                ->paginate(21);
        } else {
            $videos = Video::where('status', 'Active')->paginate(21);
        }

        return view('frontend::frontend.video', compact('frontend_setting','video_categories','videos'));
    }

    public function video_comment_store(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['video_id'] = $request->post_id;

        try {
            VideoComment::create($input);
            return redirect()->back();

		} catch (Exception $e) {
            return redirect()->back();
		}
    }

    public function video_single($slug)
    {
        $frontend_setting   = FrontendSetting::first();
        $video_categories    = VideoCategory::where('status','Active')->get();
        $video               = Video::where('slug',$slug)->first();
        $recent_videos       = Video::where('status', 'Active')->orderBy('id','DESC')->limit(4)->get();
        $video_comments      = VideoComment::where('video_id', $video->id)->get();

        $share_component = \Share::page(
            route('frontend.video.single', $video->slug),
            $video->title,
            ['target' => '_parent']
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();

        if($video){
            return view('frontend::frontend.video_single', compact('frontend_setting','video_categories','video','recent_videos','share_component','video_comments'));
        }else{
            return abort(404);
        }

    }

    public function react(Request $request)
    {
        $video = Video::find($request->video_id);
        $reactionType = $request->input('reaction_type'); // Assuming you pass 'like', 'love', etc. as 'reaction_type'
        $video->$reactionType++;
        $video->save();

        return response()->json(['success' => true,'video'=>$video]);
    }

    public function blog()
    {
        $frontend_setting   = FrontendSetting::first();
        $post_categories    = PostCategory::where('status','Active')->get();
        if(isset(request()->code) && !empty(request()->code)){
            $posts              = Post::where('status','Active')
                                        ->whereHas('category', function ($query) {
                                            $query->where('code', request()->code);
                                        })
                                        ->paginate(21);
        }else{
            $posts              = Post::where('status','Active')->paginate(21);
        }

        return view('frontend::frontend.blog', compact('frontend_setting','post_categories','posts'));
    }

    public function blog_single($slug)
    {
        $frontend_setting   = FrontendSetting::first();
        $post_categories    = PostCategory::where('status','Active')->get();
        $post               = Post::where('slug',$slug)->first();
        $recent_posts       = Post::where('status', 'Active')->orderBy('id','DESC')->limit(5)->get();
        $post_comments      = PostComment::where('post_id', $post->id)->get();

        $share_component = \Share::page(
            route('frontend.blog.single', $post->slug),
            $post->title,
            ['target' => '_parent']
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();

        if($post){
            return view('frontend::frontend.blog_single', compact('frontend_setting','post_categories','post','recent_posts','post_comments','share_component'));
        }else{
            return abort(404);
        }
    }

    public function blog_comment_store(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        try {
            PostComment::create($input);
            return redirect()->back();
			// $success_msg            = __('core::core.message.success.store');
            // return response()->json(['success'=>$success_msg], 200);

		} catch (Exception $e) {
			// $error_msg              = __('core::core.message.error');
            // return response()->json(['error'=>$error_msg]);
            return redirect()->back();
		}
    }

    public function search(Request $request)
    {
        $frontend_setting   = FrontendSetting::first();

        $video_categories       = VideoCategory::where('status','Active')->get();
        $videos                 = Video::where('status','Active')
                                        ->where('title','like',"%$request->keyword%")
                                        ->orWhere('seo_title','like',"%$request->keyword%")
                                        ->orWhere('seo_keyword','like',"%$request->keyword%")
                                        ->orWhere('seo_description','like',"%$request->keyword%")
                                        ->paginate(20);

        $post_categories        = PostCategory::where('status','Active')->get();
        $posts                  = Post::where('status','Active')
                                        ->where('title','like',"%$request->keyword%")
                                        ->orWhere('seo_title','like',"%$request->keyword%")
                                        ->orWhere('seo_keyword','like',"%$request->keyword%")
                                        ->orWhere('seo_description','like',"%$request->keyword%")
                                        ->paginate(20);

        return view('frontend::frontend.search', compact('frontend_setting','video_categories','videos','post_categories','posts'));
    }

    public function live()
    {
        $frontend_setting   = FrontendSetting::first();
        $live               = Live::where('status','Active')->first();

        return view('frontend::frontend.live', compact('frontend_setting','live'));
    }

    public function subscription()
    {
        $frontend_setting       = FrontendSetting::first();
        $subscriptions           = Subscription::where('status','Active')->get();

        return view('frontend::frontend.subscription', compact('frontend_setting','subscriptions'));
    }

    public function checkout(Request $request)
    {
        $frontend_setting       = FrontendSetting::first();
        $payment_gateways       = PaymentGateway::where('status','Active')->get();
        $subscription           = Subscription::find($request->subscription_id);
        $page                   = Page::where('slug','termes-et-conditions')->first();

        if(!$subscription){
            abort('404');
        }

        return view('frontend::frontend.checkout', compact('frontend_setting','subscription','payment_gateways','page'));
    }

    public function donation()
    {
        $frontend_setting   = FrontendSetting::first();
        return view('frontend::frontend.donation', compact('frontend_setting'));
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

    public function page_single($slug)
    {
        $frontend_setting   = FrontendSetting::first();
        $page_categories    = PageCategory::where('status','Active')->get();
        $page               = Page::where('slug',$slug)->first();

        if($page){
            return view('frontend::frontend.page_single', compact('frontend_setting','page_categories','page'));
        }else{
            return abort(404);
        }
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
