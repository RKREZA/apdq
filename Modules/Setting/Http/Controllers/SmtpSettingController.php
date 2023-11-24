<?php

namespace Modules\Setting\Http\Controllers;

use DB;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use Modules\Setting\Entities\SmsHistory;
use Spatie\Permission\Models\Permission;
use Modules\Setting\Entities\SmsTemplate;
use Illuminate\Contracts\Support\Renderable;

class SmtpSettingController extends Controller
{
    public function index(Request $request)
	{
        return view('setting::smtp.index');
	}

    public function email_setting(Request $request)
    {
        $rules = [
            'mail_mailer' => 'nullable|string',
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|string',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_from_address' => 'nullable|string',
            'mail_encryption' =>'nullable|string',
            'mail_from_name' => 'nullable|string',
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

			$success_msg = __('setting::smtp.message.update.success');
            return redirect()->route('admin.setting.smtpsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::smtp.message.update.error');
			return redirect()->route('admin.setting.smtpsettings.index')->with('error',$error_msg);
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


}
