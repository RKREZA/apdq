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
use Modules\Address\Entities\District;
use Modules\Address\Entities\Division;
use Yajra\DataTables\Facades\DataTables;
use Modules\Address\Entities\Subdistrict;
use Modules\FrontEndManager\Entities\Cms;

use Modules\Upload\Entities\UploadCategory;
use Modules\FrontEndManager\Entities\Slider;
use Modules\Beneficiary\Entities\Beneficiary;
use Modules\FrontEndManager\Entities\Gallery;
use Modules\FrontEndManager\Entities\Homeinfo;
use Modules\Documentation\Entities\Documentation;
use Modules\FrontEndManager\Entities\CmsCategory;
use Modules\FrontEndManager\Entities\Dictum;
use Modules\FrontEndManager\Entities\FrontendSetting;
use Modules\FrontEndManager\Entities\SuccessStory;
use Modules\ProjectProfile\Entities\ProjectProfile;
use Modules\FrontEndManager\Entities\GalleryCategory;
use Modules\FrontEndManager\Entities\HeroSection;
use Modules\FrontEndManager\Entities\MapData;
use Modules\FrontEndManager\Entities\WelcomeSection;
use Modules\Geo\Entities\City;
use Modules\News\Entities\News;
use Modules\Notice\Entities\Notice;
use Modules\Publication\Entities\Publication;
use Modules\Stoppage\Entities\Stoppage;
use Modules\Vehicle\Entities\Vehicle;
use Modules\VehicleRoute\Entities\VehicleRoute;

class FrontEndController extends Controller
{
    public function home()
    {
        $frontend_setting   = FrontendSetting::first();
        $vehicleroutes      = VehicleRoute::where('status','Active')->get();
        $stoppages          = Stoppage::where('status','Active')->orderBy('name','asc')->get();

        if(Session::has('city')){
            $stoppages      = Stoppage::where('status','Active')->where('city_id',Session::get('city')->id)->orderBy('name','asc')->get();
        }

        return view('frontend::frontend.home', compact(
            'frontend_setting',
            'vehicleroutes',
            'stoppages'
        ));
    }

    public function get_routes(Request $request)
	{
        $result_vehicle_routes = [];
        $html = null;

        $from_parts = explode(",", $request->from);
        $from_latitude = $from_parts[0];
        $from_longitude = $from_parts[1];
        $from       = Stoppage::where('lat',$from_latitude)->where('lon',$from_longitude)->first();



        $to_parts = explode(",", $request->to);
        $to_latitude = $to_parts[0];
        $to_longitude = $to_parts[1];
        $to       = Stoppage::where('lat',$to_latitude)->where('lon',$to_longitude)->first();


        // 1st algorithm
        $venhicle_route = VehicleRoute::where('start_stoppage_id', $from->id)->where('end_stoppage_id', $to->id)->first();
        if($venhicle_route){
            array_push($result_vehicle_routes, $venhicle_route);
        }

        if(count($result_vehicle_routes)>0){
            foreach ($result_vehicle_routes as $key => $result_vehicle_route) {
                $html = "<li>";
                $html .="<button type='hidden' value='$result_vehicle_route->id' class='location'>";
                $html .="<div class=''>";
                $html .="<h5 class='m-0'>$result_vehicle_route->name</h5>";
                $html .="</div>";
                $html .="</li>";
            }
        }

        return $html;

        // return view('frontend::frontend.routes', compact(
        //     'frontend_setting',
        //     'vehicleroutes',
        //     'stoppages',
        //     'result_vehicle_routes',
        //     'from',
        //     'to'
        // ));

	}



    public function get_route_by_id(Request $request)
	{
        $venhicle_route = VehicleRoute::find($request->result_vehicle_route_id);
        if($venhicle_route){
            $result['venhicle_route'] = $venhicle_route;
            $result['start'] = $venhicle_route->start_stoppage;
            $result['end'] = $venhicle_route->end_stoppage;
            $result['vehicle_stoppages'] = $venhicle_route->vehicle_stoppages;
            return $result;
        }
	}


    public function set_city(Request $request)
	{
        $city = City::find($request->id);
        if($city){
            Session::put('city',$city);
            $success_msg        = "City selected successfully!";
            return response()->json(['success'=> $success_msg]);
        }
	}


}
