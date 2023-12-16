<?php
namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\User\Entities\Permission;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\Entities\PermissionGroup;
use Modules\User\Entities\Role;
use Modules\User\Http\Requests\StoreRoleRequest;
use Modules\User\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:role-list', ['only' => ['index']]);
		$this->middleware('permission:role-create', ['only' => ['create','store']]);
		$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:role-delete', ['only' => ['destroy']]);
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Role::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){
					if (Gate::check('role-edit')) {
                        $edit = '<a href="'.route('admin.roles.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" title="'.__('core::core.form.edit-button').'" data-toggle="tooltip">
                                        <i class="material-icons text-sm">edit</i>
                                </a>';
                    }else{
                        $edit = '';
                    }

                    // if (Gate::check('role-delete')) {
                    //     $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.roles.trash').'" title="'.__('core::core.form.trash-button').'" data-toggle="tooltip">
					// 					<i class="material-icons text-sm">delete</i>
					// 				</button>';
                    // }else{
                    //     $delete = '';
                    // }

                    $action = $edit;
                    return $action;
                })

                ->addColumn('two_fa', function($row){

                	if ($row->two_fa == "Active") {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}

                    $status = "<input type='checkbox' id='status_$row->id' id='user-$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>";

                    return $status;
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
		// $roles = Role::all();
		return view('user::roles.index');

	}

	public function trashes(Request $request)
	{
		if ($request->ajax()) {
            $data = Role::onlyTrashed();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){
                    if (Gate::check('user-delete')) {
                        $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.roles.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">restore</i>
									</button>';
                    }else{
                        $restore = '';
                    }

                    if (Gate::check('user-delete')) {
                        $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.roles.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">delete_forever</i>
									</button>';
                    }else{
                        $delete = '';
                    }

                    $action = $restore.' '.$delete;
                    return $action;
                })

                ->addColumn('status', function($row){

                	if ($row->status == "Active") {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}

                    $status = "<input type='checkbox' id='status_$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>";

                    return $status;
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
		// $roles = Role::all();
		return view('user::roles.trashes');

	}

	public function create()
	{
		$permissiongroups = PermissionGroup::orderBy('name')->get();
		return view('user::roles.create',compact('permissiongroups'));
	}

	public function store(StoreRoleRequest $request)
	{
        DB::beginTransaction();

		try {
			$role = Role::create([
				'name' => $request->input('name')
			]);
			// $role->syncPermissions($request->input('permission'));
            $role->givePermissionTo($request->input('permission'));

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.roles.index')->with('error',$error_msg);
		}
        DB::commit();
		$success_msg = __('core::core.message.success.store');
		return redirect()->route('admin.roles.index')->with('success',$success_msg);
    }

	public function edit($id)
	{
		$permissiongroups = PermissionGroup::orderBy('name')->get();
		$role = Role::find($id);
		$permission = Role::get();
		$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
			->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
			->all();
		return view('user::roles.edit',compact('role','permission','rolePermissions','permissiongroups'));
	}

	public function update(UpdateRoleRequest $request, $id)
	{
        DB::beginTransaction();

        try {
			$role = Role::find($id);
			$role->name = $request->input('name');
			$role->save();
			$role->syncPermissions($request->input('permission'));

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.roles.index')->with('error',$error_msg);
		}
        DB::commit();
		$success_msg = __('core::core.message.success.update');
		return redirect()->route('admin.roles.index')->with('success',$success_msg);
	}




	public function trash()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            Role::find($id)->delete();
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
        DB::beginTransaction();
        foreach($ids as $id){
            try {
                Role::find($id)->delete();
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

		try {
            Role::onlyTrashed()->find($id)->forceDelete();
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
        DB::beginTransaction();
        foreach($ids as $id){
            try {
                $permission = Role::find($id);
                if ($permission) {
                    $permission->forceDelete();
                }else{
                    Role::onlyTrashed()->find($id)->forceDelete();
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
            Role::onlyTrashed()->find($id)->restore();
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
                Role::onlyTrashed()->find($id)->restore();
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



	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    $user               = Role::find($request->id)->update(['two_fa' => $request->status]);
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
        }
        DB::commit();
        $success_msg        = __('core::core.message.success.update');
        return response()->json(['success'=> $success_msg]);

	}
}
