<?php

namespace Modules\Setting\Http\Controllers;

use DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use Modules\Setting\Entities\SmsHistory;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Modules\Setting\Entities\SmsTemplate;
use Illuminate\Contracts\Support\Renderable;

class SmsSettingController extends Controller
{
    public function index(Request $request)
	{
        return view('setting::sms.index');
	}

    public function sms(Request $request)
	{
        if ($request->ajax()) {
            $data = SmsHistory::query();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('sms_to', function($row){
                    $email_to =  unserialize($row->sms_to);
                    return $email_to;
                })

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
        return view('setting::sms.sms');
	}

    public function sms_setting(Request $request)
    {
        $rules = [
            'sms_username' => 'nullable|string',
            'sms_password' => 'nullable|string',
            'sms_api_key' => 'nullable|string',
            'sms_acode' => 'nullable|string',
            'sms_masking' => 'nullable|string',
            'sms_is_unicode' => 'nullable|string',
        ];

        $this->validate($request, $rules);
        $inputs      = $request->all();

        if ($inputs['_token']) {
            unset($inputs['_token']);
        }

		try {
            foreach($inputs as $key=>$value){
                $this->putPermanentEnv($key, $value);
            }
            // Artisan::call('optimize');

			$success_msg = __('setting::sms.message.update.success');
            return redirect()->route('admin.setting.smssettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::sms.message.update.error');
			return redirect()->route('admin.setting.smssettings.index')->with('error',$error_msg);
		}


    }

    public function putPermanentEnv($key, $value)
    {
        $path = base_path('.env');
        $config = 'app.'.$key;
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                strtoupper($key).'='.config($config), strtoupper($key).'='.$value, file_get_contents($path)
            ));
        }
    }

    public function sms_send(Request $request)
    {
        // dd($request->all());
        $rules = [
            'sms_to' => 'nullable|array',
            'sms_body' => 'nullable|string',
        ];

        $this->validate($request, $rules);
        $input      = $request->all();

		try {

            $mobile = array();

            foreach ($input['sms_to'] as $key => $value) {
                array_push($mobile, $value);
            }

            $fields = array(
                "auth" => array(
                    "username"  => config('app.sms_username'),
                    "password"  => config('app.sms_password'),
                    "acode"     => config('app.sms_acode'),
                ),

                "smsInfo" => array(
                    "message"   => $input['sms_body'],
                    "masking"   => config('app.sms_masking'),
                    "is_unicode"=> config('app.sms_is_unicode'),
                    "msisdn"    => $mobile
                ),

            );

            $url = 'http://bulkmsg.teletalk.com.bd/api/sendSMS';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($response);

            if($response->description=='Success'){
                $sms_history = SmsHistory::create([
                    'sms_to' => serialize($request->input('sms_to')),
                    'sms_body' => $request->input('sms_body'),
                ]);

                $success_msg = __('setting::sms.message.send.success');
                return redirect()->route('admin.setting.smssettings.sms')->with('success',$success_msg);
            } else {
                $error_msg = __('setting::sms.message.send.error');
			    return redirect()->route('admin.setting.smssettings.sms')->with('error',$error_msg);
            }


		} catch (Exception $e) {
			$error_msg = __('setting::sms.message.send.error');
			return redirect()->route('admin.setting.smssettings.sms')->with('error',$error_msg);
		}


    }



}
