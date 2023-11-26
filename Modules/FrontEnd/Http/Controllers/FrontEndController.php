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

class FrontEndController extends Controller
{
    public function home()
    {
        $frontend_setting   = FrontendSetting::first();

        return view('frontend::frontend.home', compact('frontend_setting'));
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
