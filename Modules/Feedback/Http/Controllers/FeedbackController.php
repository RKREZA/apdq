<?php

namespace Modules\Feedback\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Feedback\Entities\Feedback;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Modules\Feedback\Entities\FeedbackCategory;
use Modules\Feedback\DataTables\FeedbacksDataTable;
use Modules\Feedback\DataTables\FeedbackTrashesDataTable;

class FeedbackController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:feedback-list', ['only' => ['index']]);
		$this->middleware('permission:feedback-view', ['only' => ['view']]);
		$this->middleware('permission:feedback-delete', ['only' => ['destroy']]);
	}

    // public function index(Request $request)
	// {
	// 	if ($request->ajax()) {
    //         $data = Feedback::query();
    //         $data->orderBy('id', 'DESC');
    //         return DataTables::of($data)
    //             ->addColumn('checkbox', function($row){
    //                 $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
    //                 return $checkbox;
    //             })
    //             ->addColumn('status', function($row){
    //                 if ($row->status == "Active") {
    //                     $current_status = 'Checked';
    //                 }else{
    //                     $current_status = '';
    //                 }

    //                 $status = "<input type='checkbox' id='status_$row->id' id='user-$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
    //                         <label for='status_$row->id' class='checktoggle'>checkbox</label>";

    //                 return $status;
    //             })

    //             ->addColumn('action', function($row){

    //                 if (Gate::check('feedback-view')) {
    //                     $view = '<a href="'.route('admin.feedbacks.view', $row->id).'" class="btn btn-sm btn-info mb-0 px-2" data-toggle="tooltip" title="'.__('core::core.form.view-button').'">
	// 									<i class="material-icons text-sm">visibility</i>
    //                             </a>';
    //                 }else{
    //                     $view = '';
    //                 }

    //                 if (Gate::check('feedback-delete')) {
    //                     $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-toggle="tooltip" title="'.__('core::core.form.trash-button').'" data-id="'.$row->id.'" data-action="'.route('admin.feedbacks.trash').'">
	// 									<i class="material-icons text-sm">delete</i>
	// 								</button>';
    //                 }else{
    //                     $delete = '';
    //                 }
    //                 $action = $view.' '.$delete;
    //                 return $action;
    //             })

    //             ->addColumn('category_id', function($row){
    //                 $category = FeedbackCategory::find($row->category_id);
    //                 if (empty($category)) {
    //                     return 'NaN';
    //                 }
    //                 return $category->name;
    //             })

    //             ->rawColumns(['action'])

    //             ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	//             ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	//             ->escapeColumns([])
    //             ->make(true);
    //     }

    //     return view('feedback::feedback.index');

	// }

    // public function trashes(Request $request)
	// {

    //     if ($request->ajax()) {
    //         $data = Feedback::onlyTrashed();
    //         $data->orderBy('id', 'DESC');
    //         return DataTables::of($data)
    //             ->addColumn('checkbox', function($row){
    //                 $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
    //                 return $checkbox;
    //             })
    //             ->addColumn('action', function($row){

    //                 if (Gate::check('feedback-restore')) {
    //                     $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.feedbacks.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
	// 									<i class="material-icons text-sm">restore</i>
	// 								</button>';
    //                 }else{
    //                     $restore = '';
    //                 }

    //                 if (Gate::check('feedback-delete')) {
    //                     $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.feedbacks.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
	// 									<i class="material-icons text-sm">delete_forever</i>
	// 								</button>';
    //                 }else{
    //                     $delete = '';
    //                 }
    //                 $action = $restore.' '.$delete;
    //                 return $action;
    //             })

    //             ->addColumn('category_id', function($row){
    //                 $category = FeedbackCategory::find($row->category_id);
    //                 if (empty($category)) {
    //                     return 'NaN';
    //                 }
    //                 return $category->name;
    //             })

    //             ->rawColumns(['action'])

    //             ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	//             ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	//             ->escapeColumns([])
    //             ->make(true);
    //     }

    //     $trashes = Feedback::onlyTrashed();

    //     return view('feedback::feedback.trashes', compact('trashes'));
	// }

    public function index(FeedbacksDataTable $dataTable)
    {
        return $dataTable->render('feedback::feedback.index');
    }
    public function trashes(FeedbackTrashesDataTable $dataTable)
    {
        return $dataTable->render('feedback::feedback.trashes');
    }

    public function view($id)
    {
        $feedback = Feedback::find($id);
        return view('feedback::feedback.view', compact('feedback'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Feedback::find($request->id)->update(['status' => $request->status]);
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
            Feedback::find($id)->delete();
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
                Feedback::find($id)->delete();
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
            $feedback = Feedback::find($id);
            if ($feedback) {
                $feedback->forceDelete();
            }else{
                Feedback::onlyTrashed()->find($id)->forceDelete();
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
                $feedback = Feedback::find($id);
                if ($feedback) {
                    $feedback->forceDelete();
                }else{
                    Feedback::onlyTrashed()->find($id)->forceDelete();
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
            Feedback::onlyTrashed()->find($id)->restore();
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
                Feedback::onlyTrashed()->find($id)->restore();
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
