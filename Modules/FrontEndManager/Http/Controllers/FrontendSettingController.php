<?php

namespace Modules\FrontEndManager\Http\Controllers;

use DB;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Support\Renderable;
use Modules\FrontEndManager\Entities\FrontendSetting;

class FrontendSettingController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:frontendsetting-list', ['only' => ['index']]);
	}


    public function index(Request $request)
	{
        $setting = FrontendSetting::first();
        return view('frontendmanager::frontendsetting.index', compact('setting'));
	}

    public function favicon(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'backend_assets/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['favicon'] = '/storage/'.$path;

            try {
                $setting    = FrontendSetting::find(1);
                $setting->update($input);

                $success_msg = __('core::core.message.success.update');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
                $error_msg = __('frontendmanager::frontendmanager.category.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function logo_light(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'backend_assets/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['logo_light'] = '/storage/'.$path;

            try {
                $setting    = FrontendSetting::find(1);
                $setting->update($input);

                $success_msg = __('core::core.message.success.update');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
                $error_msg = __('frontendmanager::frontendmanager.category.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function logo_dark(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'backend_assets/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['logo_dark'] = '/storage/'.$path;

            try {
                $setting    = FrontendSetting::find(1);
                $setting->update($input);

                $success_msg = __('core::core.message.success.update');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
                $error_msg = __('frontendmanager::frontendmanager.category.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function meta_image(Request $request)
	{
        if ($request->ajax()) {
            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'backend_assets/img/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['meta_image'] = '/storage/'.$path;

            try {
                $setting    = FrontendSetting::find(1);
                $setting->update($input);

                $success_msg = __('core::core.message.success.update');
                return response()->json(['success'=>$success_msg]);
            } catch (Exception $e) {
                $error_msg = __('frontendmanager::frontendmanager.category.message.update.error');
                return response()->json(['success'=>$error_msg]);
            }
        }
	}

    public function update_info(Request $request)
    {
        $rules = [
            'title' 					=> 'nullable',
			'description' 			        => 'nullable',
        ];

        $messages = [];

        $this->validate($request, $rules, $messages);

		try {
            $input      = $request->all();
            $setting    = FrontendSetting::find(1);
			$setting->update($input);

			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('frontendmanager::frontendmanager.category.message.update.error');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('error',$error_msg);
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
            $setting    = FrontendSetting::find(1);
			$setting->update($input);

			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('error',$error_msg);
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
            $setting    = FrontendSetting::find(1);
			$setting->update($input);

			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('error',$error_msg);
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
            $setting    = FrontendSetting::find(1);
			$setting->update($input);

			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.frontendmanager.frontendsettings.index')->with('error',$error_msg);
		}
    }
}
