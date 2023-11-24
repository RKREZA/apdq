<?php

namespace Modules\Admin\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function profile()
    {
        $user = User::find(auth()->user()->id);

        return view('admin::profile', compact('user'));
    }


    public function update_profile_photo(Request $request)
    {
        if ($request->ajax()) {

            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'user_photos/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['photo'] = '/storage/'.$path;

            try {
                $user       = User::find(auth()->user()->id);
                $user->update($input);

                $success_msg = __('core::core.message.success.update');
                return response()->json(['success'=>$success_msg]);

            } catch (Exception $e) {
                $error_msg = __('core::core.message.error');
                return response()->json(['danger'=>$error_msg]);
            }
        }
    }


    public function update_profile_name(Request $request)
    {

        /*
        * Validate all input fields
        */
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $name = $request->name;
            $user = User::find(Auth::user()->id);
            $user->name = $name;
            $user->save();

            $success_msg = __('core::core.message.success.update');
            // return response()->json(['success'=>$success_msg]);
            return back()->with('success', $success_msg);

        } catch (Exception $e) {
            $error_msg = __('core::core.message.error');
            return response()->json(['danger'=>$error_msg]);
        }
    }

    public function update_profile_mobile(Request $request)
    {

        /*
        * Validate all input fields
        */
        $request->validate([
            'mobile' => 'required',
        ]);

        try {
            $mobile = $request->mobile;
            $user = User::find(Auth::user()->id);
            $user->mobile = $mobile;
            $user->save();

            $success_msg = __('core::core.message.success.update');
            // return response()->json(['success'=>$success_msg]);
            return back()->with('success', $success_msg);

        } catch (Exception $e) {
            $error_msg = __('core::core.message.error');
            return response()->json(['danger'=>$error_msg]);
        }
    }


    public function update_password(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        /*
        * Validate all input fields
        */
        $request->validate([
            'old_password' => 'required',
            'password' => 'confirmed|min:6|different:old_password',
        ]);


        if (Hash::check($request->old_password, $user->password)) {

            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $success_msg = __('admin::auth.profile.message.password.success');
            $request->session()->flash('success', $success_msg);
            return redirect()->route('admin.profile');
        } else {
            $error_msg = __('admin::auth.profile.message.password.error');
            $request->session()->flash('danger', $error_msg);
            return redirect()->route('admin.profile');
        }
    }

    public function update_signature_photo(Request $request)
    {
        if ($request->ajax()) {

            $request->validate([
			    'file' 			=> 'required|mimes:png,jpg,gif,jpeg|max:1024',
            ]);

            $input          = $request->all();
            $directory      = 'user_signatures/'.auth()->user()->id;
            $path           = Storage::disk('public')->put($directory, $request->file('file'));
		    $input['signature'] = '/storage/'.$path;

            try {
                $user       = User::find(auth()->user()->id);
                $user->update($input);

                $success_msg = __('core::core.message.success.update');
                return response()->json(['success'=>$success_msg]);

            } catch (Exception $e) {
                $error_msg = __('core::core.message.error');
                return response()->json(['danger'=>$error_msg]);
            }
        }
    }

    public function media_manager()
    {
        return view('admin::media_manager');
    }
}
