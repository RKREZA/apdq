<?php

namespace Modules\Faq\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Faq\DataTables\FaqCategoryDataTable;
use Modules\Faq\DataTables\FaqCategoryTrashesDataTable;
use Modules\Faq\Entities\FaqCategory;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class FaqCategoryController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:faqcategory-list', ['only' => ['index']]);
		$this->middleware('permission:faqcategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:faqcategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:faqcategory-delete', ['only' => ['destroy']]);
	}

    public function index(FaqCategoryDataTable $dataTable)
    {
        return $dataTable->render('faq::category.index');
    }

    public function trashes(FaqCategoryTrashesDataTable $dataTable)
    {
        return $dataTable->render('faq::category.trashes');
    }

    public function create()
    {
        $faqcategory = Permission::get();
        return view('faq::category.create', compact('faqcategory'));
    }

    public function store(Request $request)
	{
        $rules = [
            'code' 					=> 'required|unique:faq_categories,code',
			'name' 			        => 'required|string',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = FaqCategory::create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.faqcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.faqcategories.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('faq::category.show');
    }

    public function edit($id)
    {
        $faqcategory = FaqCategory::find($id);
        return view('faq::category.edit', compact('faqcategory'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			=> 'required',
            'code'          => 'required|unique:faq_categories,code,'.$id,
        ];
        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$faqcategory = FaqCategory::find($id);
		try {
			$faqcategory->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.faqcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.faqcategories.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    FaqCategory::find($request->id)->update(['status' => $request->status]);
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
            FaqCategory::find($id)->delete();
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
                FaqCategory::find($id)->delete();
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
            $faq = FaqCategory::find($id);
            if ($faq) {
                $faq->forceDelete();
            }else{
                FaqCategory::onlyTrashed()->find($id)->forceDelete();
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
                $faq = FaqCategory::find($id);
                if ($faq) {
                    $faq->forceDelete();
                }else{
                    FaqCategory::onlyTrashed()->find($id)->forceDelete();
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
            FaqCategory::onlyTrashed()->find($id)->restore();
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
                FaqCategory::onlyTrashed()->find($id)->restore();
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
