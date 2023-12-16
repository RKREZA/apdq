<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Announcement\Entities\Announcement;
use Modules\Video\Entities\Video;
use Modules\Subscription\Entities\Subscription;
use Modules\Newsletter\Entities\Newsletter;
use Modules\Transaction\Entities\Transaction;
use Modules\Faq\Entities\Faq;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        if(auth()->user()->hasRole('Admin')){
            $announcements  = Announcement::where('status','Active')->get();
            $videos         = Video::count();
            $subscriptions  = Subscription::count();
            $newsletters    = Newsletter::count();
            $transactions   = Transaction::where('status', 'Paid')->get();
            return view('admin::dashboard.admin_dashboard', compact('announcements','videos','subscriptions','newsletters','transactions'));
        }else{
            $announcements  = Announcement::where('status','Active')->get();
            $transactions   = Transaction::where('status', 'Paid')->get();
            $faqs           = Faq::where('status', 'Active')->get();
            return view('admin::dashboard.user_dashboard', compact('announcements','faqs','transactions'));
        }
    }


}
