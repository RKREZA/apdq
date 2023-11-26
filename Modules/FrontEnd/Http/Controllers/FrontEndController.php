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

class FrontEndController extends Controller
{
    public function home()
    {
        $frontend_setting   = FrontendSetting::first();

        return view('frontend::frontend.home');
    }

}
