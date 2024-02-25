<?php

namespace Modules\Newsletter\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Newsletter\DataTables\NewsletterCategoryDataTable;
use Modules\Newsletter\DataTables\NewsletterCategoryTrashesDataTable;
use Modules\Newsletter\Entities\NewsletterCategory;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class NewsletterCategoryController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:newslettercategory-list', ['only' => ['index']]);
		$this->middleware('permission:newslettercategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:newslettercategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:newslettercategory-delete', ['only' => ['destroy']]);
	}

    public function index(NewsletterCategoryDataTable $dataTable)
    {
        return $dataTable->render('newsletter::category.index');
    }

    public function trashes(NewsletterCategoryTrashesDataTable $dataTable)
    {
        return $dataTable->render('newsletter::category.trashes');
    }

    public function create()
    {
        $newslettercategory = Permission::get();
        return view('newsletter::category.create', compact('newslettercategory'));
    }

    public function store(Request $request)
	{
        $rules = [
            'code' 					=> 'required|unique:newsletter_categories,code',
			'name' 			        => 'required|string',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = NewsletterCategory::create([
                'serial' => $request->input('serial'),
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.newslettercategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.newslettercategories.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('newsletter::category.show');
    }

    public function edit($id)
    {
        $newslettercategory = NewsletterCategory::find($id);
        return view('newsletter::category.edit', compact('newslettercategory'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			=> 'required',
            'code'          => 'required|unique:newsletter_categories,code,'.$id,
        ];
        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$newslettercategory = NewsletterCategory::find($id);
		try {
			$newslettercategory->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.newslettercategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.newslettercategories.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    NewsletterCategory::find($request->id)->update(['status' => $request->status]);
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
            // newsletterCategory::find($id)->delete();
            $category = NewsletterCategory::find($id);

            if($category->newsletters->count() > 0){
                DB::commit();
                $error_msg  = __('newsletter::newsletter.category.message.error_newsletter_exist_with_this_category');
                return response()->json(['error'=>$error_msg]);
            }

            $category->delete();
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
                // newsletterCategory::find($id)->delete();
                $category = NewsletterCategory::find($id);

                if($category->newsletters->count() > 0){
                    $error_msg  = __('newsletter::newsletter.category.message.error_newsletter_exist_with_this_category');
                    return response()->json(['error'=>$error_msg]);
                }

                $category->delete();
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
            // $newsletter = newsletterCategory::find($id);

            $category = NewsletterCategory::find($id);

            if($category->newsletters->count() > 0){
                DB::commit();
                $error_msg  = __('newsletter::newsletter.category.message.error_newsletter_exist_with_this_category');
                return response()->json(['error'=>$error_msg]);
            }

            if ($category) {
                $category->forceDelete();
            }else{
                NewsletterCategory::onlyTrashed()->find($id)->forceDelete();
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
                // $newsletter = newsletterCategory::find($id);

                $category = NewsletterCategory::find($id);

                if($category->newsletters->count() > 0){
                    $error_msg  = __('newsletter::newsletter.category.message.error_newsletter_exist_with_this_category');
                    return response()->json(['error'=>$error_msg]);
                }

                if ($category) {
                    $category->forceDelete();
                }else{
                    NewsletterCategory::onlyTrashed()->find($id)->forceDelete();
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
            NewsletterCategory::onlyTrashed()->find($id)->restore();
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
                NewsletterCategory::onlyTrashed()->find($id)->restore();
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
