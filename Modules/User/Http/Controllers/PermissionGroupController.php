<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Modules\User\Entities\PermissionGroup;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\StorePermissionGroupRequest;
use Modules\User\Http\Requests\UpdatePermissionGroupRequest;

class PermissionGroupController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:permissiongroup-list', ['only' => ['index']]);
		$this->middleware('permission:permissiongroup-create', ['only' => ['create','store']]);
		$this->middleware('permission:permissiongroup-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:permissiongroup-delete', ['only' => ['destroy']]);
	}

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = PermissionGroup::orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){
					if (Gate::check('permissiongroup-edit')) {
                        $edit = '<a href="'.route('admin.permissiongroups.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" title="'.__('core::core.form.edit-button').'" data-toggle="tooltip">
                                        <i class="material-icons text-sm">edit</i>
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('permissiongroup-delete')) {
                        $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.permissiongroups.destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">delete</i>
									</button>';
                    }else{
                        $delete = '';
                    }


                    $action = $edit.' '.$delete;

                    return $action;
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }

        return view('user::permissiongroup.index');

	}

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::permissiongroup.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StorePermissionGroupRequest $request)
	{
        DB::beginTransaction();
		try {
			$permissiongroup = PermissionGroup::create([
                'name'          => $request->input('name'),
                'display_name'  => $request->input('display_name'),
                'description'          => $request->input('description')
            ]);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.permissiongroups.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg = __('core::core.message.success.store');
        return redirect()->route('admin.permissiongroups.index')->with('success',$success_msg);
	}


    public function edit($id)
    {
        $permissiongroup = PermissionGroup::find($id);
        return view('user::permissiongroup.edit', compact('permissiongroup'));
    }


    public function update(UpdatePermissionGroupRequest $request, $id)
	{
        DB::beginTransaction();
		try {
            $input = $request->all();
            $permissiongroup = PermissionGroup::find($id);
			$permissiongroup->update($input);


		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.permissiongroups.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg = __('core::core.message.success.update');
        return redirect()->route('admin.permissiongroups.index')->with('success',$success_msg);

	}


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy()
    {
        DB::beginTransaction();
        $id = request()->input('id');

        try {
            PermissionGroup::find($id)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg = __('core::core.message.error');
            return response()->json(['success'=>$error_msg]);
        }
        DB::commit();
        $success_msg = __('core::core.message.success.destroy');
        return response()->json(['success'=>$success_msg]);
    }

    public function delete_all(Request $request)
    {
        $ids = explode(",",$request->ids);

        DB::beginTransaction();
        foreach($ids as $id){
            $permissiongroup = PermissionGroup::find($id);
            try {
                $permissiongroup->delete();
            } catch (Exception $e) {
                DB::rollBack();
                $error_msg = __('core::core.message.error');
                return redirect()->route('admin.permissiongroups.index')->with('error',$error_msg);
            }
        }
        DB::commit();
        $success_msg = __('core::core.message.success.destroy');
        return response()->json(['success'=>$success_msg]);
    }


    public function status_update(Request $request)
	{
        DB::beginTransaction();
        try{
            $status = PermissionGroup::find($request->id)->update(['status' => $request->status]);
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
