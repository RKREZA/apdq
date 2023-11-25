<?php

namespace Modules\Cms\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Cms\Entities\Page;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Cms\Entities\PageCategory;
use Yajra\DataTables\Facades\DataTables;
use Modules\Cms\DataTables\PagesDataTable;
use Modules\Cms\DataTables\PageTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubePage;

class PageController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:page-list', ['only' => ['index']]);
		$this->middleware('permission:page-create', ['only' => ['create','store']]);
		$this->middleware('permission:page-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:page-view', ['only' => ['view']]);
		$this->middleware('permission:page-delete', ['only' => ['destroy']]);
	}

    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('cms::page.index');
    }
    public function trashes(PageTrashesDataTable $dataTable)
    {
        return $dataTable->render('cms::page.trashes');
    }

    public function create()
    {
        $pagecategories = PageCategory::get();
        return view('cms::page.create', compact('pagecategories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' 					=> 'required',
			'description' 			    => 'required|string',
			'tag' 			            => 'required|string',
			'category_id' 			    => 'required',
			'seo_title' 			    => 'nullable|string',
			'seo_description' 		    => 'nullable|string',
			'seo_keyword' 			    => 'nullable|string'
        ];

        $messages = [
            'title.required'    		=> __('core::core.form.validation.required'),
            'description.required'      => __('core::core.form.validation.required'),
            'tag.required'              => __('core::core.form.validation.required'),
            'category_id.required'      => __('core::core.form.validation.required'),
            'seo_title.required'        => __('core::core.form.validation.required'),
            'seo_description.required'  => __('core::core.form.validation.required'),
            'seo_keyword.required'      => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);
        // dd($request->all());
		try {
			$page = Page::create([
                'title'         => $request->input('title'),
                'category_id'   => $request->input('category_id'),
                'description'   => $request->input('description'),
                'tag'           => $request->input('tag'),
                'category_id'   => $request->input('category_id'),
                'seo_title'     => $request->input('seo_title'),
                'seo_description'=> $request->input('seo_description'),
                'seo_keyword'   => $request->input('seo_keyword')
            ]);

            if (!empty($request->input('files'))) {
                $files = explode(',',$request->input('files'));
                $files = array_filter($files);
                $page->files()->attach($files);
            }

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.pages.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.pages.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $page = Page::find($id);

        if(count($page->files)>0){
            foreach($page->files as $file){
                $files[]    = $file->id;
            }
            $file_ids       = implode(',',$files);
        }else{
            $file_ids       = '';
        }

        return view('cms::page.edit', compact('page','file_ids'));
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
            $page        = Page::find($id);
			$page->update($input);

            if (!empty($input['files'])) {
                $files          = explode(',',$input['files']);
                $files          = array_filter($files);
                $page->files()->sync($files);
            }

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.pages.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.pages.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $page = Page::find($id);
        return view('cms::page.view', compact('page'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Page::find($request->id)->update(['status' => $request->status]);
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
            Page::find($id)->delete();
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
                Page::find($id)->delete();
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
            $page = Page::find($id);
            if ($page) {
                $page->forceDelete();
            }else{
                Page::onlyTrashed()->find($id)->forceDelete();
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
                $page = Page::find($id);
                if ($page) {
                    $page->forceDelete();
                }else{
                    Page::onlyTrashed()->find($id)->forceDelete();
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
            Page::onlyTrashed()->find($id)->restore();
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
                Page::onlyTrashed()->find($id)->restore();
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
