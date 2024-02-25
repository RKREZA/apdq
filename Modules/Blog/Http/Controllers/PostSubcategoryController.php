<?php

namespace Modules\Blog\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Blog\DataTables\PostSubcategoryDataTable;
use Modules\Blog\DataTables\PostSubcategoryTrashesDataTable;
use Modules\Blog\Entities\PostSubcategory;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PostSubcategoryController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:postsubcategory-list', ['only' => ['index']]);
		$this->middleware('permission:postsubcategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:postsubcategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:postsubcategory-delete', ['only' => ['destroy']]);
	}

    public function index(PostSubcategoryDataTable $dataTable)
    {
        return $dataTable->render('blog::subcategory.index');
    }

    public function trashes(PostSubcategoryTrashesDataTable $dataTable)
    {
        return $dataTable->render('blog::subcategory.trashes');
    }

    public function create()
    {
        $postsubcategory = Permission::get();
        return view('blog::subcategory.create', compact('postsubcategory'));
    }

    public function store(Request $request)
	{
        $rules = [
            'code' 					=> 'required|unique:post_subcategories,code',
			'name' 			        => 'required|string',
			'description' 			=> 'nullable|string',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = PostSubcategory::create([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'description' => $request->input('description')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.postsubcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.postsubcategories.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('blog::subcategory.show');
    }

    public function edit($id)
    {
        $postsubcategory = PostSubcategory::find($id);
        return view('blog::subcategory.edit', compact('postsubcategory'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			        => 'required',
			'description' 			=> 'nullable|string',
        ];
        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$postsubcategory = PostSubcategory::find($id);
		try {
			$postsubcategory->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.postsubcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.postsubcategories.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    PostSubcategory::find($request->id)->update(['status' => $request->status]);
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
            $subcategory = PostSubcategory::find($id);

            if($subcategory->posts->count() > 0){
                DB::commit();
                $error_msg  = __('blog::blog.category.message.error_post_exist_with_this_category');
                return response()->json(['error'=>$error_msg]);
            }

            $subcategory->delete();

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

                $subcategory = PostSubcategory::find($id);

                if($subcategory->posts->count() > 0){
                    $error_msg  = __('blog::blog.category.message.error_post_exist_with_this_category');
                    return response()->json(['error'=>$error_msg]);
                }

                $subcategory->delete();

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
            $subcategory = PostSubcategory::find($id);

            if($subcategory->posts->count() > 0){
                DB::commit();
                $error_msg  = __('blog::blog.category.message.error_post_exist_with_this_category');
                return response()->json(['error'=>$error_msg]);
            }

            if ($subcategory) {
                $subcategory->forceDelete();
            }else{
                PostSubcategory::onlyTrashed()->find($id)->forceDelete();
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

                $subcategory = PostSubcategory::find($id);

                if($subcategory->posts->count() > 0){
                    $error_msg  = __('blog::blog.category.message.error_post_exist_with_this_category');
                    return response()->json(['error'=>$error_msg]);
                }

                if ($subcategory) {
                    $subcategory->forceDelete();
                }else{
                    PostSubcategory::onlyTrashed()->find($id)->forceDelete();
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
            PostSubcategory::onlyTrashed()->find($id)->restore();
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
                PostSubcategory::onlyTrashed()->find($id)->restore();
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
