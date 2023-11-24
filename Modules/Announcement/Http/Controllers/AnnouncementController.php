<?php

namespace Modules\Announcement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Modules\Announcement\Entities\Announcement;

class AnnouncementController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:announcement-list', ['only' => ['index']]);
		$this->middleware('permission:announcement-create', ['only' => ['create','store']]);
		$this->middleware('permission:announcement-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:announcement-delete', ['only' => ['destroy']]);
	}

    public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Announcement::query();
            $data->orderBy('id', 'DESC');
            return DataTables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){
					if (Gate::check('announcement-edit')) {
                        $edit = '<a href="'.route('admin.announcements.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" data-toggle="tooltip" title="'.__('core::core.form.edit-button').'">
                                    <i class="material-icons text-sm">edit</i>
                            </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('announcement-delete')) {
                        $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-toggle="tooltip" title="'.__('core::core.form.trash-button').'" data-id="'.$row->id.'" data-action="'.route('admin.announcements.trash').'">
										<i class="material-icons text-sm">delete</i>
									</button>';
                    }else{
                        $delete = '';
                    }
                    $action = $edit.' '.$delete;
                    return $action;
                })

                ->addColumn('description', function($row){
                	$description = substr(strip_tags($row->description), 0, 100);
                    return mb_convert_encoding($description, 'UTF-8', 'UTF-8');
                })

                ->addColumn('status', function($row){
                	if ($row->status == "Active") {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}
                    $status = "
                            <input type='checkbox' id='status_$row->id' id='announcement-$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";

                    return $status;
                })

                ->addColumn('public', function($row){
                	if ($row->public == 1) {
                		$current_status = '<span class="badge badge-warning badge-md">Public</span>';
                	}else{
                		$current_status = '<span class="badge badge-success badge-md">Private</span>';
                	}
                    return $current_status;
                })

                ->addColumn('blink', function($row){
                	if ($row->blink == 1) {
                		$current_status = '<span class="badge badge-secondary badge-md">On</span>';
                	}else{
                		$current_status = '<span class="badge badge-secondary badge-md">Off</span>';
                	}
                    return $current_status;
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
        return view('announcement::announcement.index');
	}

    public function trashes(Request $request)
	{
		if ($request->ajax()) {
            $data = Announcement::onlyTrashed();
            $data->orderBy('id', 'DESC');
            return DataTables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){

                    if (Gate::check('feedback-restore')) {
                        $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.announcements.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">restore</i>
									</button>';
                    }else{
                        $restore = '';
                    }

                    if (Gate::check('feedback-delete')) {
                        $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.announcements.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">delete_forever</i>
									</button>';
                    }else{
                        $delete = '';
                    }
                    $action = $restore.' '.$delete;
                    return $action;
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }

        $trashes = Announcement::onlyTrashed();

        return view('announcement::announcement.trashes', compact('trashes'));
	}

    public function create()
    {
        $announcement = Permission::get();
        return view('announcement::announcement.create', compact('announcement'));
    }

    public function store(Request $request)
	{
        $rules = [
            'description' 		    => 'required|string',
			'type' 			        => 'required|string',
        ];

        $messages = [
            'description.required'  => __('core::core.form.validation.required'),
            'type.required'    		=> __('core::core.form.validation.required'),
        ];

        $this->validate($request, $rules, $messages);

		try {
			Announcement::create([
                'description' => $request->input('description'),
                'public' => $request->input('public'),
                'blink' => $request->input('blink'),
                'type' => $request->input('type')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.announcements.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.announcements.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('announcement::announcement.show');
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        return view('announcement::announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'description' 		    => 'required|string',
			'type' 			        => 'required|string',
        ];

        $messages = [
            'description.required'    		=> __('core::core.form.validation.required'),
            'type.required'    		=> __('core::core.form.validation.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$announcement = Announcement::find($id);
		try {
			$announcement->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.announcements.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.announcements.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Announcement::find($request->id)->update(['status' => $request->status]);
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
		try {
            Announcement::find($id)->delete();
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
                Announcement::find($id)->delete();
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
            $feedback = Announcement::find($id);
            if ($feedback) {
                $feedback->forceDelete();
            }else{
                Announcement::onlyTrashed()->find($id)->forceDelete();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg = __('core::core.message.error');
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
                $feedback = Announcement::find($id);
                if ($feedback) {
                    $feedback->forceDelete();
                }else{
                    Announcement::onlyTrashed()->find($id)->forceDelete();
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
            Announcement::onlyTrashed()->find($id)->restore();
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
                Announcement::onlyTrashed()->find($id)->restore();
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
