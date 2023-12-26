<?php

namespace Modules\Slider\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Slider\DataTables\SliderCategoryDataTable;
use Modules\Slider\DataTables\SliderCategoryTrashesDataTable;
use Modules\Slider\Entities\SliderCategory;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class SliderCategoryController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:slidercategory-list', ['only' => ['index']]);
		$this->middleware('permission:slidercategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:slidercategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:slidercategory-delete', ['only' => ['destroy']]);
	}

    public function index(SliderCategoryDataTable $dataTable)
    {
        return $dataTable->render('slider::category.index');
    }

    public function trashes(SliderCategoryTrashesDataTable $dataTable)
    {
        return $dataTable->render('slider::category.trashes');
    }

    public function create()
    {
        $slidercategory = Permission::get();
        return view('slider::category.create', compact('slidercategory'));
    }

    public function store(Request $request)
	{
        $rules = [
            'code' 					=> 'required|unique:slider_categories,code',
			'name' 			        => 'required|string',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = SliderCategory::create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.slidercategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.slidercategories.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('slider::category.show');
    }

    public function edit($id)
    {
        $slidercategory = SliderCategory::find($id);
        return view('slider::category.edit', compact('slidercategory'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			=> 'required',
            'code'          => 'required|unique:slider_categories,code,'.$id,
        ];
        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$slidercategory = SliderCategory::find($id);
		try {
			$slidercategory->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.slidercategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.slidercategories.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    SliderCategory::find($request->id)->update(['status' => $request->status]);
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
            SliderCategory::find($id)->delete();
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
                SliderCategory::find($id)->delete();
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
            $slider = SliderCategory::find($id);
            if ($slider) {
                $slider->forceDelete();
            }else{
                SliderCategory::onlyTrashed()->find($id)->forceDelete();
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
                $slider = SliderCategory::find($id);
                if ($slider) {
                    $slider->forceDelete();
                }else{
                    SliderCategory::onlyTrashed()->find($id)->forceDelete();
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
            SliderCategory::onlyTrashed()->find($id)->restore();
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
                SliderCategory::onlyTrashed()->find($id)->restore();
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
