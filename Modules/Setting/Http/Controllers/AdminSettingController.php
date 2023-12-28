<?php

namespace Modules\Setting\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setting\Entities\Setting;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class AdminSettingController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:adminsetting-list', ['only' => ['index']]);

        $permissions_adminsetting_categories_list = Permission::get()->filter(function($item) {
            return $item->name == 'adminsetting-list';
        })->first();


        if ($permissions_adminsetting_categories_list == null) {
            Permission::create(['name'=>'adminsetting-list']);
        }
	}


    public function index(Request $request)
	{
        $setting = Setting::find(1);
        return view('setting::adminsetting.index', compact('setting'));
	}
    public function favicon(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg,webp|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'assets/backend/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['favicon'] = '/storage/'.$path;

            try {
                $setting    = Setting::find(1);
                $setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function logo_light(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg,webp|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'assets/backend/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['logo_light'] = '/storage/'.$path;

            try {
                $setting    = Setting::find(1);
                $setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function logo_dark(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg,webp|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'assets/backend/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['logo_dark'] = '/storage/'.$path;

            try {
                $setting    = Setting::find(1);
                $setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function update_info(Request $request)
    {
        $rules = [
            'title' 					=> 'nullable',
			'description' 			    => 'nullable',
        ];

        $messages = [];

        $this->validate($request, $rules, $messages);

		try {
            $input      = $request->all();
            $setting    = Setting::find(1);
			$setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
			return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
			return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
		}
    }

    public function meta_image(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg,webp|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'assets/backend/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['meta_image'] = '/storage/'.$path;

            try {
                $setting    = Setting::find(1);
                $setting->update($input);

                $success_msg = __('setting::setting.adminsetting.message.update.success');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
                $error_msg = __('setting::setting.adminsetting.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function update_meta(Request $request)
    {
        $rules = [
            'meta_title' 					=> 'nullable',
			'meta_description' 			    => 'nullable',
			'meta_keywords' 			    => 'nullable',
			'social_title' 			        => 'nullable',
			'social_description' 			=> 'nullable',
        ];

        $messages = [];

        $this->validate($request, $rules, $messages);

		try {
            $input      = $request->all();
            $setting    = Setting::find(1);
			$setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
			return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
			return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
		}
    }

    public function update_preloader(Request $request)
    {
        $rules = [
            'preloader_status' 					=> 'nullable',
        ];

        $messages = [];

        $this->validate($request, $rules, $messages);
        $input      = $request->all();


        if(!isset($input['preloader_status'])){
            $input['preloader_status'] = 'Inactive';
        }else{
            $input['preloader_status'] = 'Active';
        }

		try {
            $setting    = Setting::find(1);
			$setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
			return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
			return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
		}
    }


    public function update_back_to_top(Request $request)
    {
        $rules = [
            'back_to_top_status' 					=> 'nullable',
        ];

        $messages = [];

        $this->validate($request, $rules, $messages);
        $input      = $request->all();

        if(isset($input['back_to_top_status'])){
            if ($input['back_to_top_status'] == 'Active') {
                $input['back_to_top_status'] = 'Inactive';
            }elseif(isset($input['back_to_top_status']) && $input['back_to_top_status'] == 'Inactive'){
                $input['back_to_top_status'] = 'Active';
            }
        }else{
            $input['back_to_top_status'] = 'Inactive';
        }

		// dd($input);
		try {
            $setting    = Setting::find(1);
			$setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
			return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
			return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
		}
    }




    public function update_copyright(Request $request)
    {
        $rules = [
            'copyright' 					=> 'nullable',
        ];

        $messages = [];

        $this->validate($request, $rules, $messages);
        $input      = $request->all();

		try {
            $setting    = Setting::find(1);
			$setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
			return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
			return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
		}
    }

    public function update_setting(Request $request)
    {
        $rules = [];
        $messages = [];

        $this->validate($request, $rules, $messages);
        $input      = $request->all();

		try {
            $setting    = Setting::find(1);
			$setting->update($input);

			$success_msg = __('setting::setting.adminsetting.message.update.success');
			return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting::setting.adminsetting.message.update.error');
			return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
		}
    }

    // public function email_setting(Request $request)
    // {
    //     $rules = [
    //         'mail_mailer' => 'nullable|string',
    //         'mail_host' => 'nullable|string',
    //         'mail_port' => 'nullable|string',
    //         'mail_username' => 'nullable|string',
    //         'mail_password' => 'nullable|string',
    //         'mail_from_address' => 'nullable|string',
    //         'mail_encryption' =>'nullable|string',
    //         'mail_from_name' => 'nullable|string',
    //     ];

    //     $this->validate($request, $rules);
    //     $inputs      = $request->all();

    //     if ($inputs['_token']) {
    //         unset($inputs['_token']);
    //     }

	// 	try {
    //         foreach($inputs as $key=>$value){
    //             $this->putPermanentEnv($key, $value);
    //         }
    //         Artisan::call('optimize');

	// 		$success_msg = __('setting::setting.category.message.update.success');
    //         return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

	// 	} catch (Exception $e) {
	// 		$error_msg = __('setting::setting.adminsetting.message.update.error');
	// 		return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
	// 	}


    // }




    // public function sms_setting(Request $request)
    // {
    //     $rules = [
    //         'sms_username' => 'nullable|string',
    //         'sms_password' => 'nullable|string',
    //         'sms_api_key' => 'nullable|string',
    //     ];

    //     $this->validate($request, $rules);
    //     $inputs      = $request->all();

    //     if ($inputs['_token']) {
    //         unset($inputs['_token']);
    //     }

	// 	try {
    //         foreach($inputs as $key=>$value){
    //             $this->putPermanentEnv($key, $value);
    //         }
    //         Artisan::call('optimize');

	// 		$success_msg = __('setting::setting.category.message.update.success');
    //         return redirect()->route('admin.setting.adminsettings.index')->with('success',$success_msg);

	// 	} catch (Exception $e) {
	// 		$error_msg = __('setting::setting.adminsetting.message.update.error');
	// 		return redirect()->route('admin.setting.adminsettings.index')->with('error',$error_msg);
	// 	}


    // }

    // public function putPermanentEnv($key, $value)
    // {
    //     $path = base_path('.env');
    //     $config = 'app.'.$key;
    //     if (file_exists($path)) {
    //         file_put_contents($path, str_replace(
    //             strtoupper($key).'='.config($config), strtoupper($key).'='.$value, file_get_contents($path)
    //         ));
    //     }
    // }


}
