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
use Modules\Video\Entities\VideoPlaylist;
use Modules\Video\Entities\VideoCategory;
use Modules\Video\Entities\Video;
use Modules\Video\Entities\VideoComment;
use Modules\Blog\Entities\PostCategory;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostComment;
use Modules\Cms\Entities\PageCategory;
use Modules\Cms\Entities\Page;
use Modules\Live\Entities\Live;
use Modules\Subscription\Entities\Subscription;
use Modules\PaymentGateway\Entities\PaymentGateway;
use Modules\Newsletter\Entities\Newsletter;
use Modules\Newsletter\Entities\NewsletterCategory;
use Modules\FrontEnd\Http\Mail\SendSubscriberConfirmationMail;
use Illuminate\Support\Facades\Validator;
use App\Mail\Http\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

use Google\Client;
use Google\Service\YouTube;


class FrontEndController extends Controller
{
    function __construct()
	{
        $frontend_setting   = FrontendSetting::first();
        $this->yearsMonths  = $this->getYearsMonths();
        View::share('yearsMonths', $this->yearsMonths);
        View::share('frontend_setting', $frontend_setting);
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

    public function setCookie(Request $request)
    {
        $cookie = cookie('subscriptionModalClosed', 'true', 60 * 24 * 30); // Create cookie
        return response()->json(['message' => 'Cookie set'])->withCookie($cookie); // Attach cookie to response
    }

    public function home()
    {
        $video_categories   = VideoCategory::where('status','Active')->orderByRaw('ISNULL(serial), serial ASC')->get();
        $videos             = Video::where('status','Active')->orderBy('id','DESC')->get();
        $posts              = Post::where('status','Active')->get();
        $lives              = Live::where('status','Active')->get();
        // $sliders            = Slider::where('status','Active')->get();

        return view('frontend::frontend.home', compact('video_categories','videos','posts','lives'));
    }

    public function about()
    {
        return view('frontend::frontend.about');
    }

    public function video()
    {
        try {
            $video_categories    = VideoCategory::where('status','Active')->orderByRaw('ISNULL(serial), serial ASC')->get();
            if (request()->has('year') && request()->has('month')) {
                $year = request()->input('year');
                $month = request()->input('month');

                $videos = Video::where('status', 'Active')
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', Carbon::parse($month)->format('m'));
            } elseif (request()->has('code') && !empty(request()->code)) {
                $videos = Video::where('status', 'Active')
                    ->whereHas('category', function ($query) {
                        $query->where('code', request()->code);
                    });
            } elseif (request()->has('tag') && !empty(request()->tag)) {
                $tag = request()->tag;

                $videos = Video::where('status', 'Active')
                    ->where(function ($query) use ($tag) {
                        $query->where('tag', 'like', "%{$tag}%")
                            ->orWhere('tag', 'like', "%{$tag},%")
                            ->orWhere('tag', 'like', "%,{$tag}%")
                            ->orWhere('tag', 'like', "{$tag},%")
                            ->orWhere('tag', 'like', "%,{$tag}");
                    });
            } elseif (request()->has('filter') && !empty(request()->filter)) {
                $videosQuery = Video::query();
                $videosQuery = $videosQuery->where('status', 'Active');

                // Apply different sorting based on the filter value
                switch (request()->filter) {
                    case 'latest':
                        $videosQuery = $videosQuery->orderBy('created_at','asc');
                        break;

                    case 'oldest':
                        $videosQuery = $videosQuery->orderBy('created_at','desc');
                        break;

                    case 'popular':
                        // Sum up all reaction counts and order by the total count in descending order
                        $videosQuery = $videosQuery->orderByRaw('`like` + `love` + `haha` + `wow` + `angry` + `dislike` DESC');
                        break;

                    default:
                        // Handle other filters if needed
                        break;
                }

                // Paginate the results
                $videos = $videosQuery;
            } else {
                $videos = Video::where('status', 'Active');
            }

            if (request()->has('code')) {
                $videos = Video::where('status', 'Active')
                    ->whereHas('category', function ($query) {
                        $query->where('code', request()->code);
                    })
                    ->paginate(20);
            }else{
                $videos = $videos->paginate(20);
            }

            return view('frontend::frontend.video', compact('video_categories','videos'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function video_oldest()
    {
        try {
            $video_categories    = VideoCategory::where('status','Active')->orderByRaw('ISNULL(serial), serial ASC')->get();
            $videos    = Video::where('status','Active')->orderBy('id','asc');

            if (request()->has('code')) {
                $videos =   $videos->whereHas('category', function ($query) {
                                $query->where('code', request()->code);
                            })
                            ->paginate(20);
            }else{
                $videos = $videos->paginate(20);
            }

            return view('frontend::frontend.video_oldest', compact('videos','video_categories'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function video_latest()
    {
        try {
            $video_categories    = VideoCategory::where('status','Active')->orderByRaw('ISNULL(serial), serial ASC')->get();
            $videos    = Video::where('status','Active')->orderBy('id','desc');

            if (request()->has('code')) {
                $videos =   $videos->whereHas('category', function ($query) {
                                $query->where('code', request()->code);
                            })
                            ->paginate(20);
            }else{
                $videos = $videos->paginate(20);
            }

            return view('frontend::frontend.video_latest', compact('videos','video_categories'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function video_popular()
    {
        try {
            $video_categories    = VideoCategory::where('status','Active')->orderByRaw('ISNULL(serial), serial ASC')->get();
            $videos    = Video::where('status','Active')->orderByRaw('`like` + `love` + `haha` + `wow` + `angry` + `dislike` DESC');

            if (request()->has('code')) {
                $videos =   $videos->whereHas('category', function ($query) {
                                $query->where('code', request()->code);
                            })
                            ->paginate(20);
            }else{
                $videos = $videos->paginate(20);
            }

            return view('frontend::frontend.video_popular', compact('videos','video_categories'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function video_playlist()
    {
        try {
            $videoplaylists = VideoPlaylist::where('status', 'Active')->paginate(20);
            return view('frontend::frontend.video_playlist', compact('videoplaylists'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function video_playlist_single($id)
    {
        try {
            $videoplaylist = VideoPlaylist::where('status','Active')->find($id);
            $videos = $videoplaylist->videos()->where('status', 'Active')->paginate(20);
            return view('frontend::frontend.video_playlist_single', compact('videoplaylist','videos'));
        } catch (\Throwable $th) {
            abort(404);
        }
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

        $video               = Video::where('slug',$slug)->first();
        if(!$video){
            abort(404);
        }

        $video_categories    = VideoCategory::where('status','Active')->orderByRaw('ISNULL(serial), serial ASC')->get();
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
            return view('frontend::frontend.video_single', compact('video_categories','video','recent_videos','share_component','video_comments'));
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

    public function get_reactions(Request $request)
    {
        $request->validate([
            'video_id'      => 'required|integer|exists:videos,id',
            // 'reaction_type' => 'required|in:like,love,haha,wow,sad,angry,dislike',
        ]);

        $videoId = $request->video_id;
        $reactionType = $request->reaction_type;
        $video = Video::select(['like', 'love', 'haha', 'wow', 'sad', 'angry', 'dislike'])->findOrFail($videoId);

        return response()->json([
            'success' => true,
            'reactions' => $video->toArray()
        ]);
    }

    public function blog()
    {
        try {
            $post_categories    = PostCategory::where('status','Active')->get();
            if(isset(request()->code) && !empty(request()->code)){
                $posts              = Post::where('status','Active')
                                            ->whereHas('category', function ($query) {
                                                $query->where('code', request()->code);
                                            })
                                            ->paginate(21);
            } elseif (request()->has('tag') && !empty(request()->tag)) {
                $tag = request()->tag;

                $posts = Post::where('status', 'Active')
                    ->where(function ($query) use ($tag) {
                        $query->where('tag', 'like', "%{$tag}%")
                            ->orWhere('tag', 'like', "%{$tag},%")
                            ->orWhere('tag', 'like', "%,{$tag}%")
                            ->orWhere('tag', 'like', "{$tag},%")
                            ->orWhere('tag', 'like', "%,{$tag}");
                    })
                    ->paginate(20);
            } else{
                $posts              = Post::where('status','Active')->paginate(21);
            }

            return view('frontend::frontend.blog', compact('post_categories','posts'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function blog_single($slug)
    {
        try {
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
                return view('frontend::frontend.blog_single', compact('post_categories','post','recent_posts','post_comments','share_component'));
            }else{
                return abort(404);
            }
        } catch (\Throwable $th) {
            abort(404);
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
        try {
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

            return view('frontend::frontend.search', compact('video_categories','videos','post_categories','posts'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function live()
    {
        // try {
            $live               = Live::where('status','Active')->where('archive','Inactive')->first();
            $messages = $this->fetchLiveChatMessagesUsingVideoId($live->external_id);
            $archived_lives     = Live::where('status','Active')->where('archive','Active')->get();
            // dd($messages);
            return view('frontend::frontend.live', compact('live','messages','archived_lives'));
        // } catch (\Throwable $th) {
        //     abort(404);
        // }
    }

    public function live_archive()
    {
        try {
            $archived_lives     = Live::where('status','Active')->where('archive','Active')->paginate(20);
            return view('frontend::frontend.live_archive', compact('archived_lives'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function live_single($slug)
    {
        try {
            $live     = Live::where('status','Active')->where('archive','Active')->where('slug',$slug)->first();
            $share_component = \Share::page(
                route('frontend.live.single', $live->slug),
                $live->title,
                ['target' => '_parent']
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp();


            $messages = $this->fetchLiveChatMessagesUsingVideoId($live->external_id);


            // dd($messages);
            return view('frontend::frontend.live_single', compact('live','share_component','messages'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }



    public function fetchLiveChatMessagesUsingVideoId($videoId)
    {
        $client = new Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));

        $youtube = new YouTube($client);

        // Step 1: Fetch the live stream details to get the liveChatId
        $liveChatId = $this->getLiveChatIdByVideoId($youtube, $videoId);

        if (!$liveChatId) {
            return []; // Or handle the absence of a liveChatId accordingly
        }

        // Step 2: Fetch live chat messages using the liveChatId
        $response = $youtube->liveChatMessages->listLiveChatMessages(
            $liveChatId,
            'snippet, authorDetails'
        );

        return $response->getItems();
    }

    private function getLiveChatIdByVideoId(YouTube $youtube, $videoId)
    {
        // Fetch the video details
        $videoResponse = $youtube->videos->listVideos('liveStreamingDetails', array(
            'id' => $videoId,
        ));

        if (empty($videoResponse->getItems())) {
            return null; // Video not found or does not have live streaming details
        }

        $video = $videoResponse->getItems()[0];

        // Check if the video has live streaming details with a valid liveChatId
        if ($video->getLiveStreamingDetails() && $video->getLiveStreamingDetails()->getActiveLiveChatId()) {
            return $video->getLiveStreamingDetails()->getActiveLiveChatId();
        }

        return null;
    }

    public function fetch_messages(Request $request) {
        $messages = $this->fetchLiveChatMessagesUsingVideoId($request->external_id);

        return response()->json(['messages' => $messages]);
    }






    public function subscription()
    {
        try {
            $subscriptions           = Subscription::where('status','Active')->get();

            return view('frontend::frontend.subscription', compact('subscriptions'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    public function checkout(Request $request)
    {
        $payment_gateways       = PaymentGateway::where('status','Active')->get();
        $subscription           = Subscription::find($request->subscription_id);
        $page                   = Page::where('slug','termes-et-conditions')->first();

        if(!$subscription){
            abort('404');
        }

        return view('frontend::frontend.checkout', compact('subscription','payment_gateways','page'));
    }

    public function donation()
    {
        return view('frontend::frontend.donation');
    }

    public function contact()
    {
        return view('frontend::frontend.contact');
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

    public function page_single($slug)
    {
        $page_categories    = PageCategory::where('status','Active')->get();
        $page               = Page::where('slug',$slug)->first();

        if($page){
            return view('frontend::frontend.page_single', compact('page_categories','page'));
        }else{
            return abort(404);
        }
    }

    public function newsletter_general(Request $request) {
        $rules = [
			'email' 			        => 'required|email',
        ];

        $messages = [
            'email.required'    		=> __('core::core.form.validation.required'),
            'email.unique'    		    => __('core::core.form.validation.unique'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $category = NewsletterCategory::where('code','general')->first();
        if (!$category) {
            $error_msg              = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        $check_email = Newsletter::where('email',$request->email)->where('category_id',$category->id)->first();
        if($check_email){
            $error_msg              = __('core::core.message.already_exist');
            return response()->json(['error'=>$error_msg]);
        }

		try {
			Newsletter::create([
                'category_id'        => $category->id,
                'email'              => $request->input('email'),
            ]);

            $data = [
                'email' => $request->email,
                'message' => 'Préparez-vous pour du contenu exclusif ! (pour les newsletters ou les abonnements avec du contenu exclusif)',
            ];

            Mail::to($request->email)->send(new SendSubscriberConfirmationMail($data));

			$success_msg            = __('core::core.message.success.subscribe');
            return response()->json(['success'=>$success_msg], 200);

		} catch (Exception $e) {
			$error_msg              = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
		}
    }



    public function newsletter_live(Request $request) {
        $rules = [
			'email' 			        => 'required|email',
        ];

        $messages = [
            'email.required'    		=> __('core::core.form.validation.required'),
            'email.unique'    		    => __('core::core.form.validation.unique'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $category = NewsletterCategory::where('code','live')->first();
        if (!$category) {
            $error_msg              = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        $check_email = Newsletter::where('email',$request->email)->where('category_id',$category->id)->first();
        if($check_email){
            $error_msg              = __('core::core.message.already_exist');
            return response()->json(['error'=>$error_msg]);
        }

		try {
			Newsletter::create([
                'category_id'        => $category->id,
                'email'              => $request->input('email'),
            ]);

            $data = [
                'email' => $request->email,
                'message' => 'Vous êtes désormais inscrit(e) pour recevoir des notifications en direct.',
            ];

            Mail::to($request->email)->send(new SendSubscriberConfirmationMail($data));

			$success_msg            = __('core::core.message.success.subscribe');
            return response()->json(['success'=>$success_msg], 200);

		} catch (Exception $e) {
			$error_msg              = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
		}
    }


    public function stripe(Request $request)
    {
        $subscription           = Subscription::find($request->subscription_id);

        $payment_gateway        = PaymentGateway::where('code','stripe')->first();
        $payment_gateway_info   = json_decode($payment_gateway->info, true); // Decoding as an associative array

        if (isset($payment_gateway_info['mode']) && $payment_gateway_info['mode'] === 'sandbox') {
            $stripe_key = $payment_gateway_info['sandbox_stripe_key'];
        } else {
            $stripe_key = $payment_gateway_info['live_stripe_key'];
        }
        $currency = $payment_gateway_info['currency'];


        return view('frontend::frontend.stripe', compact('subscription','payment_gateway','stripe_key','currency'));
    }



    public function delete_user()
    {
        return view('frontend::frontend.home');
    }
    public function privacy_policy()
    {
        return view('frontend::frontend.home');
    }
    public function terms_of_services()
    {
        return view('frontend::frontend.home');
    }

}
