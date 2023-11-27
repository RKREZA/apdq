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
        $announcements = Announcement::where('status','Active')->get();
        $videos = Video::count();
        $subscriptions = Subscription::count();
        $newsletters = Newsletter::count();
        $transactions = Transaction::sum('payment_amount');
        return view('admin::dashboard', compact('announcements','videos','subscriptions','newsletters','transactions'));
    }


}
