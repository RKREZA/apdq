<?php

namespace Modules\Slider\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Slider\Entities\Slider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Slider\Entities\SliderCategory;
use Modules\Video\Entities\Video;
use Modules\Live\Entities\Live;
use Yajra\DataTables\Facades\DataTables;
use Modules\Slider\DataTables\SlidersDataTable;
use Modules\Slider\DataTables\SliderTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubeslider;

class SliderController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:slider-list', ['only' => ['index']]);
		$this->middleware('permission:slider-create', ['only' => ['create','store']]);
		$this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:slider-view', ['only' => ['view']]);
		$this->middleware('permission:slider-delete', ['only' => ['destroy']]);
	}

    public function index(SlidersDataTable $dataTable)
    {
        return $dataTable->render('slider::slider.index');
    }
    public function trashes(SliderTrashesDataTable $dataTable)
    {
        return $dataTable->render('slider::slider.trashes');
    }

    public function create()
    {
        $slidercategories = SliderCategory::where('status','Active')->get();
        $videos = Video::where('status','Active')->get();
        $lives = Live::where('status','Active')->get();
        return view('slider::slider.create', compact('slidercategories','videos','lives'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' 					=> 'required|string',
			'description' 			    => 'required|string',
			'category_id' 			    => 'required',
			'url' 			            => 'nullable|string',
			'video_id' 			        => 'nullable',
			'live_id' 			        => 'nullable',
        ];

        $messages = [
            'title.required'    		=> __('core::core.form.validation.required'),
            'description.required'      => __('core::core.form.validation.required'),
            'category_id.required'      => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

		try {
			$slider = Slider::create([
                'title'         => $request->input('title'),
                'category_id'   => $request->input('category_id'),
                'description'   => $request->input('description'),
                'url'           => $request->input('url'),
                'category_id'   => $request->input('category_id'),
                'video_id'      => $request->input('video_id'),
                'live_id'       => $request->input('live_id'),
            ]);

            if (!empty($request->input('files'))) {
                $files = explode(',',$request->input('files'));
                $files = array_filter($files);
                $slider->files()->attach($files);
            }

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.sliders.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.sliders.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        $slidercategories = SliderCategory::where('status','Active')->get();
        $videos = Video::where('status','Active')->get();
        $lives = Live::where('status','Active')->get();

        if(count($slider->files)>0){
            foreach($slider->files as $file){
                $files[]    = $file->id;
            }
            $file_ids       = implode(',',$files);
        }else{
            $file_ids       = '';
        }

        return view('slider::slider.edit', compact('slider','file_ids','slidercategories','videos','lives'));
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
            $slider        = Slider::find($id);
			$slider->update($input);

            if (!empty($input['files'])) {
                $files          = explode(',',$input['files']);
                $files          = array_filter($files);
                $slider->files()->sync($files);
            }

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.sliders.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.sliders.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $slider = Slider::find($id);
        return view('slider::slider.view', compact('slider'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Slider::find($request->id)->update(['status' => $request->status]);
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
            Slider::find($id)->delete();
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
                Slider::find($id)->delete();
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
            $slider = Slider::find($id);
            if ($slider) {
                $slider->forceDelete();
            }else{
                Slider::onlyTrashed()->find($id)->forceDelete();
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
                $slider = Slider::find($id);
                if ($slider) {
                    $slider->forceDelete();
                }else{
                    Slider::onlyTrashed()->find($id)->forceDelete();
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
            Slider::onlyTrashed()->find($id)->restore();
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
                Slider::onlyTrashed()->find($id)->restore();
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
