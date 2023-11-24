<?php

namespace Modules\Faq\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Faq\Entities\Faq;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Faq\Entities\FaqCategory;
use Yajra\DataTables\Facades\DataTables;
use Modules\Faq\DataTables\FaqsDataTable;
use Modules\Faq\DataTables\FaqTrashesDataTable;

class FaqController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:faq-list', ['only' => ['index']]);
		$this->middleware('permission:faq-create', ['only' => ['create','store']]);
		$this->middleware('permission:faq-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:faq-view', ['only' => ['view']]);
		$this->middleware('permission:faq-delete', ['only' => ['destroy']]);
	}

    public function index(FaqsDataTable $dataTable)
    {
        return $dataTable->render('faq::faq.index');
    }
    public function trashes(FaqTrashesDataTable $dataTable)
    {
        return $dataTable->render('faq::faq.trashes');
    }
    
    public function create()
    {
        $faqcategories = FaqCategory::get();
        return view('faq::faq.create', compact('faqcategories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' 					=> 'required',
			'description' 			    => 'required|string',
        ];

        $messages = [
            'title.required'    		=> __('core::core.form.validation.required'),
            'description.required'   => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = Faq::create([
                'title'         => $request->input('title'),
                'category_id'   => $request->input('category_id'),
                'description'   => $request->input('description')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.faqs.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.faqs.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('faq::faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' 					=> 'required',
			'description' 	            => 'required|string',
        ];

        $messages = [
            'title.required'    	=> __('core::core.form.validation.required'),
            'description.required'  => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

        
        DB::beginTransaction();
		try {
            $input       = $request->all();
            $cms         = Faq::find($id);
			$cms->update($input);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.faqs.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.faqs.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $faq = Faq::find($id);
        return view('faq::faq.view', compact('faq'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Faq::find($request->id)->update(['status' => $request->status]);
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
            Faq::find($id)->delete();
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
                Faq::find($id)->delete();
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
            $faq = Faq::find($id);
            if ($faq) {
                $faq->forceDelete();
            }else{
                Faq::onlyTrashed()->find($id)->forceDelete();
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
                $faq = Faq::find($id);
                if ($faq) {
                    $faq->forceDelete();
                }else{
                    Faq::onlyTrashed()->find($id)->forceDelete();
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
            Faq::onlyTrashed()->find($id)->restore();
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
                Faq::onlyTrashed()->find($id)->restore();
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
