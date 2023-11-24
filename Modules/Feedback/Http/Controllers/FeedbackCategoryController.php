<?php

namespace Modules\Feedback\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Modules\Feedback\Entities\FeedbackCategory;
use Modules\Feedback\DataTables\FeedbackCategoriesDataTable;
use Modules\Feedback\DataTables\FeedbackCategoryTrashesDataTable;

class FeedbackCategoryController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:feedbackcategory-list', ['only' => ['index']]);
		$this->middleware('permission:feedbackcategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:feedbackcategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:feedbackcategory-delete', ['only' => ['destroy']]);
	}

    // public function index(Request $request)
	// {
	// 	if ($request->ajax()) {
    //         $data = FeedbackCategory::query();
    //         $data->orderBy('id', 'DESC');
    //         return DataTables::of($data)
    //             ->addColumn('checkbox', function($row){
    //                 $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
    //                 return $checkbox;
    //             })
    //             ->addColumn('action', function($row){
	// 				if (Gate::check('feedbackcategory-edit')) {
    //                     $edit = '<a href="'.route('admin.feedbackcategories.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" data-toggle="tooltip" title="'.__('core::core.form.edit-button').'">
    //                                 <i class="material-icons text-sm">edit</i>
    //                         </a>';
    //                 }else{
    //                     $edit = '';
    //                 }

    //                 if (Gate::check('feedbackcategory-delete')) {
    //                     $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-toggle="tooltip" title="'.__('core::core.form.trash-button').'" data-id="'.$row->id.'" data-action="'.route('admin.feedbackcategories.trash').'">
	// 									<i class="material-icons text-sm">delete</i>
	// 								</button>';
    //                 }else{
    //                     $delete = '';
    //                 }
    //                 $action = $edit.' '.$delete;
    //                 return $action;
    //             })

    //             ->addColumn('status', function($row){
    //             	if ($row->status == "Active") {
    //             		$current_status = 'Checked';
    //             	}else{
    //             		$current_status = '';
    //             	}
    //                 $status = "
    //                         <input type='checkbox' id='status_$row->id' id='feedbackcategory-$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
	// 						<label for='status_$row->id' class='checktoggle'>checkbox</label>
    //                 ";

    //                 return $status;
    //             })

    //             ->rawColumns(['action'])

    //             ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	//             ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	//             ->escapeColumns([])
    //             ->make(true);
    //     }
    //     return view('feedback::category.index');
	// }

    // public function trashes(Request $request)
	// {
	// 	if ($request->ajax()) {
    //         $data = FeedbackCategory::onlyTrashed();
    //         $data->orderBy('id', 'DESC');
    //         return DataTables::of($data)
    //             ->addColumn('checkbox', function($row){
    //                 $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
    //                 return $checkbox;
    //             })
    //             ->addColumn('action', function($row){

    //                 if (Gate::check('feedback-restore')) {
    //                     $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.feedbackcategories.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
	// 									<i class="material-icons text-sm">restore</i>
	// 								</button>';
    //                 }else{
    //                     $restore = '';
    //                 }

    //                 if (Gate::check('feedback-delete')) {
    //                     $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.feedbackcategories.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
	// 									<i class="material-icons text-sm">delete_forever</i>
	// 								</button>';
    //                 }else{
    //                     $delete = '';
    //                 }
    //                 $action = $restore.' '.$delete;
    //                 return $action;
    //             })

    //             ->rawColumns(['action'])

    //             ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	//             ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	//             ->escapeColumns([])
    //             ->make(true);
    //     }

    //     $trashes = FeedbackCategory::onlyTrashed();

    //     return view('feedback::category.trashes', compact('trashes'));
	// }

    public function index(FeedbackCategoriesDataTable $dataTable)
    {
        return $dataTable->render('feedback::category.index');
    }
    public function trashes(FeedbackCategoryTrashesDataTable $dataTable)
    {
        return $dataTable->render('feedback::category.trashes');
    }

    public function create()
    {
        $feedbackcategory = Permission::get();
        return view('feedback::category.create', compact('feedbackcategory'));
    }

    public function store(Request $request)
	{
        $rules = [
            'code' 					=> 'required|unique:feedback_categories,code',
			'name' 			        => 'required|string',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = FeedbackCategory::create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.feedbackcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.feedbackcategories.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('feedback::category.show');
    }

    public function edit($id)
    {
        $feedbackcategory = FeedbackCategory::find($id);
        return view('feedback::category.edit', compact('feedbackcategory'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			=> 'required',
            'code'          => 'required|unique:feedback_categories,code,'.$id,
        ];
        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$feedbackcategory = FeedbackCategory::find($id);
		try {
			$feedbackcategory->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.feedbackcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.feedbackcategories.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    FeedbackCategory::find($request->id)->update(['status' => $request->status]);
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
            FeedbackCategory::find($id)->delete();
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
                FeedbackCategory::find($id)->delete();
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
            $feedback = FeedbackCategory::find($id);
            if ($feedback) {
                $feedback->forceDelete();
            }else{
                FeedbackCategory::onlyTrashed()->find($id)->forceDelete();
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
                $feedback = FeedbackCategory::find($id);
                if ($feedback) {
                    $feedback->forceDelete();
                }else{
                    FeedbackCategory::onlyTrashed()->find($id)->forceDelete();
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
            FeedbackCategory::onlyTrashed()->find($id)->restore();
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
                FeedbackCategory::onlyTrashed()->find($id)->restore();
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
