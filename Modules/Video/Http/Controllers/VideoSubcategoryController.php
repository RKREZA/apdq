<?php

namespace Modules\Video\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Video\DataTables\VideoSubcategoryDataTable;
use Modules\Video\DataTables\VideoSubcategoryTrashesDataTable;
use Modules\Video\Entities\VideoSubcategory;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class VideoSubcategoryController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:videosubcategory-list', ['only' => ['index']]);
		$this->middleware('permission:videosubcategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:videosubcategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:videosubcategory-delete', ['only' => ['destroy']]);
	}

    public function index(VideoSubcategoryDataTable $dataTable)
    {
        return $dataTable->render('video::subcategory.index');
    }

    public function trashes(VideoSubcategoryTrashesDataTable $dataTable)
    {
        return $dataTable->render('video::subcategory.trashes');
    }

    public function create()
    {
        $videosubcategory = Permission::get();
        return view('video::subcategory.create', compact('videosubcategory'));
    }

    public function store(Request $request)
	{
        $rules = [
            'code' 					=> 'required|unique:video_subcategories,code',
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
			$role = VideoSubcategory::create([
                'serial' => $request->input('serial'),
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'description' => $request->input('description')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.videosubcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.videosubcategories.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('video::subcategory.show');
    }

    public function edit($id)
    {
        $videosubcategory = VideoSubcategory::find($id);
        return view('video::subcategory.edit', compact('videosubcategory'));
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
		$videosubcategory = VideoSubcategory::find($id);
		try {
			$videosubcategory->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.videosubcategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.videosubcategories.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    VideoSubcategory::find($request->id)->update(['status' => $request->status]);
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
            $category = VideoSubcategory::find($id);

            if($category->videos->count() > 0){
                DB::commit();
                $error_msg  = __('video::video.category.message.error_video_exist_with_this_category');
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

                $category = VideoSubcategory::find($id);

                if($category->videos->count() > 0){
                    $error_msg  = __('video::video.category.message.error_video_exist_with_this_category');
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
            $category = VideoSubcategory::find($id);

            if($category->videos->count() > 0){
                DB::commit();
                $error_msg  = __('video::video.category.message.error_video_exist_with_this_category');
                return response()->json(['error'=>$error_msg]);
            }

            if ($category) {
                $category->forceDelete();
            }else{
                VideoSubcategory::onlyTrashed()->find($id)->forceDelete();
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

                $category = VideoSubcategory::find($id);

                if($category->videos->count() > 0){
                    $error_msg  = __('video::video.category.message.error_video_exist_with_this_category');
                    return response()->json(['error'=>$error_msg]);
                }

                if ($category) {
                    $category->forceDelete();
                }else{
                    VideoSubcategory::onlyTrashed()->find($id)->forceDelete();
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
            VideoSubcategory::onlyTrashed()->find($id)->restore();
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
                VideoSubcategory::onlyTrashed()->find($id)->restore();
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
