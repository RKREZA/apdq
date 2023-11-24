<?php

namespace Modules\Video\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Video\DataTables\VideoCategoryDataTable;
use Modules\Video\DataTables\VideoCategoryTrashesDataTable;
use Modules\Video\Entities\VideoCategory;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class VideoCategoryController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:videocategory-list', ['only' => ['index']]);
		$this->middleware('permission:videocategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:videocategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:videocategory-delete', ['only' => ['destroy']]);
	}

    public function index(VideoCategoryDataTable $dataTable)
    {
        return $dataTable->render('video::category.index');
    }

    public function trashes(VideoCategoryTrashesDataTable $dataTable)
    {
        return $dataTable->render('video::category.trashes');
    }

    public function create()
    {
        $videocategory = Permission::get();
        return view('video::category.create', compact('videocategory'));
    }

    public function store(Request $request)
	{
        $rules = [
            'code' 					=> 'required|unique:video_categories,code',
			'name' 			        => 'required|string',
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$role = VideoCategory::create([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.videocategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.videocategories.index')->with('error',$error_msg);
		}
	}

    public function show($id)
    {
        return view('video::category.show');
    }

    public function edit($id)
    {
        $videocategory = VideoCategory::find($id);
        return view('video::category.edit', compact('videocategory'));
    }

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			=> 'required',
            'code'          => 'required|unique:video_categories,code,'.$id,
        ];
        $messages = [
            'name.required'    		=> __('core::core.form.validation.required'),
            'code.required'    		=> __('core::core.form.validation.required'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$videocategory = VideoCategory::find($id);
		try {
			$videocategory->update($input);
			$success_msg = __('core::core.message.success.update');
			return redirect()->route('admin.videocategories.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.videocategories.index')->with('error',$error_msg);
		}

	}


	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    VideoCategory::find($request->id)->update(['status' => $request->status]);
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
            VideoCategory::find($id)->delete();
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
                VideoCategory::find($id)->delete();
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
            $video = VideoCategory::find($id);
            if ($video) {
                $video->forceDelete();
            }else{
                VideoCategory::onlyTrashed()->find($id)->forceDelete();
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
                $video = VideoCategory::find($id);
                if ($video) {
                    $video->forceDelete();
                }else{
                    VideoCategory::onlyTrashed()->find($id)->forceDelete();
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
            VideoCategory::onlyTrashed()->find($id)->restore();
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
                VideoCategory::onlyTrashed()->find($id)->restore();
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
