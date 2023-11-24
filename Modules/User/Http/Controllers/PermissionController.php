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
use Modules\User\Http\Requests\StorePermissionRequest;
use Modules\User\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:permission-list', ['only' => ['index']]);
		$this->middleware('permission:permission-create', ['only' => ['create','store']]);
		$this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:permission-delete', ['only' => ['destroy']]);
	}

	public function index(Request $request)
	{
        if ($request->ajax()) {
            $data = Permission::query();
            $data->orderBy('id', 'DESC');

            // $data = Permission::orderBy('id','DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){
					if (Gate::check('permission-edit')) {
                        $edit = '<a href="'.route('admin.permissions.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" title="'.__('core::core.form.edit-button').'" data-toggle="tooltip">
                                        <i class="material-icons text-sm">edit</i>
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('permission-delete')) {
                        $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.permissions.trash').'" title="'.__('core::core.form.trash-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">delete</i>
									</button>';
                    }else{
                        $delete = '';
                    }

                    $action = $edit.' '.$delete;
                    return $action;
                })

                ->addColumn('permissiongroup_id', function($row){
                	if ($row->permissiongroup_id != null) {
						$permissiongroup = PermissionGroup::find($row->permissiongroup_id);
                    	return $permissiongroup->name;
					}else{
						return 'N/A';
					}
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }

        $trashes = Permission::onlyTrashed();
		return view('user::permissions.index', compact('trashes'));
	}

	public function trashes(Request $request)
	{
        if ($request->ajax()) {
            $data = Permission::onlyTrashed();
            $data->orderBy('id', 'DESC');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){
                    if (Gate::check('user-delete')) {
                        $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.permissions.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">restore</i>
									</button>';
                    }else{
                        $restore = '';
                    }

                    if (Gate::check('user-delete')) {
                        $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.permissions.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">delete_forever</i>
									</button>';
                    }else{
                        $delete = '';
                    }

                    $action = $restore.' '.$delete;
                    return $action;
                })

                ->addColumn('permissiongroup_id', function($row){
                	if ($row->permissiongroup_id != null) {
						$permissiongroup = PermissionGroup::find($row->permissiongroup_id);
                    	return $permissiongroup->name;
					}else{
						return 'N/A';
					}
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }

        $trashes = Permission::onlyTrashed();
		return view('user::permissions.trashes');
	}

	public function create()
	{
        $permissiongroups = PermissionGroup::get();
		return view('user::permissions.create',compact('permissiongroups'));
	}

	public function store(StorePermissionRequest $request)
	{
        DB::beginTransaction();
		try {
            $input              = request()->all();
			$permission         = Permission::create($input);
		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.permissions.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg = __('core::core.message.success.store');
        return redirect()->route('admin.permissions.index')->with('success',$success_msg);
	}


	public function edit($id)
	{
        $permission = Permission::find($id);
        $permissiongroups = PermissionGroup::get();
		return view('user::permissions.edit',compact('permission','permissiongroups'));
	}

	public function update(UpdatePermissionRequest $request, $id)
	{
        DB::beginTransaction();
		try {
            $input              = $request->all();
            $permission         = Permission::find($id);
			$update             = $permission->update($input);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.permissions.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg = __('core::core.message.success.update');
        return redirect()->route('admin.permissions.index')->with('success',$success_msg);
	}

	public function trash()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            Permission::find($id)->delete();
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
                Permission::find($id)->delete();
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
            Permission::onlyTrashed()->find($id)->forceDelete();
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
                $permission = Permission::find($id);
                if ($permission) {
                    $permission->forceDelete();
                }else{
                    Permission::onlyTrashed()->find($id)->forceDelete();
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
            Permission::onlyTrashed()->find($id)->restore();
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
                Permission::onlyTrashed()->find($id)->restore();
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
