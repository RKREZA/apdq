<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Core\Entities\File;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Modules\User\DataTables\UsersDataTable;
use Modules\User\DataTables\UserTrashesDataTable;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:user-list', ['only' => ['index']]);
		$this->middleware('permission:user-create', ['only' => ['create','store']]);
		$this->middleware('permission:user-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:user-delete', ['only' => ['destroy']]);
		$this->middleware('permission:user-file', ['only' => ['file']]);
	}


    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('user::users.index');
    }
    public function trashes(UserTrashesDataTable $dataTable)
    {
        return $dataTable->render('user::users.trashes');
    }

	public function create()
	{
		$roles              = Role::pluck('name','name')->all();
		return view('user::users.create',compact('roles'));
	}

	public function store(StoreUserRequest $request)
	{
        DB::beginTransaction();
		try {
            $input              = request()->all();
            $input['password']  = Hash::make($input['password']);
			$user               = User::create($input);
			$user->assignRole($request->input('roles'));

            if (!empty($request->input('files'))) {
                $files = explode(',',$request->input('files'));
                $files = array_filter($files);
                $user->files()->attach($files);
            }

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg          = __('core::core.message.error');
			return redirect()->route('admin.users.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg        = __('core::core.message.success.store');
        return redirect()->route('admin.users.index')->with('success',$success_msg);
	}

	public function edit($id)
	{
		$user               = User::find($id);
		$roles              = Role::pluck('name','name')->all();
		$userRole           = $user->roles->pluck('name','name')->all();
        if(count($user->files)>0){
            foreach($user->files as $file){
                $files[]    = $file->id;
            }
            $file_ids       = implode(',',$files);
        }else{
            $file_ids       = '';
        }

		return view('user::users.edit',compact('user', 'roles','userRole','file_ids'));
	}

	public function update(UpdateUserRequest $request, $id)
	{
        DB::beginTransaction();
		try {
            $input          = $request->all();
            $user           = User::find($id);

            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input['password'] = $user->password;
            }

			$update         = $user->update($input);
			DB::table('model_has_roles')->where('model_id',$id)->delete();
			$assignRole     = $user->assignRole($request->input('roles'));

            if (!empty($input['files'])) {
                $files          = explode(',',$input['files']);
                $files          = array_filter($files);
                $user->files()->sync($files);
            }

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.users.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.users.index')->with('success',$success_msg);

	}

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    $user               = User::find($request->id)->update(['status' => $request->status]);
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg        = __('core::core.message.success.update');
        return response()->json(['success'=> $success_msg]);

	}

	public function trash()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		if(auth()->user()->id == $id){
			$warning_msg    = __('user::user.message.destroy.warning_current_user');
            return response()->json(['warning'=>$warning_msg]);
		}

		try {
            User::find($id)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.trash');
        return response()->json(['success'=>$success_msg]);

	}

    public function trash_all(Request $request)
    {
        $ids                = explode(",",$request->ids);
        $auth_user          = array_search(auth()->user()->id, $ids);
        if ($auth_user !== false) {
            unset($ids[$auth_user]);
        }

        DB::beginTransaction();
        foreach($ids as $id){
            try {
                User::find($id)->delete();
            } catch (Exception $e) {
                DB::rollBack();
                $error_msg = __('core::core.message.error');
                return response()->json(['error'=>$error_msg]);
            }
        }
        DB::commit();
        $success_msg = __('core::core.message.success.trash');
        return response()->json(['success'=>$success_msg]);
    }

	public function force_destroy()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		if(auth()->user()->id == $id){
			$warning_msg    = __('user::user.message.destroy.warning_current_user');
            return response()->json(['warning'=>$warning_msg]);
		}

		try {

            $user = User::onlyTrashed()->find($id);
            $user->forceDelete();

            // Delete File
            $user->onlyTrashed()->find($id);
            foreach ($user->files as $value) {
                $file = File::find($value->id);
                unlink($file->path);
                $file->delete();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.destroy');
        return response()->json(['success'=>$success_msg]);

	}

    public function force_destroy_all(Request $request)
    {
        $ids                = explode(",",$request->ids);
        $auth_user          = array_search(auth()->user()->id, $ids);
        if ($auth_user !== false) {
            unset($ids[$auth_user]);
        }

        DB::beginTransaction();
        foreach($ids as $id){
            try {
                $user = User::find($id);
                if ($user) {
                    $user->forceDelete();

                    // Delete File
                    $user->onlyTrashed()->find($id);
                    foreach ($user->files as $value) {
                        $file = File::find($value->id);
                        unlink($file->path);
                        $file->delete();
                    }
                }else{
                    User::onlyTrashed()->find($id)->forceDelete();
                }
            } catch (Exception $e) {
                DB::rollBack();
                $error_msg = __('core::core.message.error');
                return response()->json(['error'=>$error_msg]);
            }
        }
        DB::commit();
        $success_msg = __('core::core.message.success.destroy');
        return response()->json(['success'=>$success_msg]);
    }

	public function restore()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            User::onlyTrashed()->find($id)->restore();
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.restore');
        return response()->json(['success'=>$success_msg]);

	}

    public function restore_all(Request $request)
	{
        $ids                = explode(",",$request->ids);
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            foreach ($ids as $id) {
                User::onlyTrashed()->find($id)->restore();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.restore');
        return response()->json(['success'=>$success_msg]);

	}

}
