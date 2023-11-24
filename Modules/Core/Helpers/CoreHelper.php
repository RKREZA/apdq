<?php
namespace Modules\Core\Helpers;

use Modules\Phase\Entities\Phase;
use Modules\ProjectForm\Entities\ProjectFormFiscalYear;

class CoreHelper
{
    public static function instance()
    {
        return new CoreHelper();
    }

    public static function filter_data($request, $data)
    {
        $data->orderBy('id', 'DESC');

        if($request->date != null){
            $data->where('date', $request->date);
        }
        if($request->status != null){
            $data->where('status','like',"%$request->status%" );
        }
        return $data;
    }

    public static function getDistance($origin, $destination, $unit = ''){
        // dd($origin);
        $api_key = 'AIzaSyDhHPOCq-RqOtN1zmTF8d7nI44jLuixlj4'; // replace with your API key

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&key=$api_key";

        $data = file_get_contents($url);

        $response = json_decode($data, true);

        $distance = $response['rows'][0]['elements'][0]['distance']['value']; // distance in meters

        // Convert unit and return distance
        $unit = strtoupper($unit);

        if($unit == "K"){
            return $distance / 1000 .' km'; // convert meters to km
        }elseif($unit == "M"){
            return $distance * 0.000621371 .' miles'; // convert meters to miles
        }else{
            return $distance.' meter';
        }
    }

}
