<?php

namespace Modules\Language\Http\Controllers;

use Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Modules\Language\Entities\Language;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Language\Http\Requests\StoreLanguageRequest;
use Modules\Language\Http\Requests\UpdateLanguageRequest;

class LanguageController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:language-list', ['only' => ['index']]);
		$this->middleware('permission:language-create', ['only' => ['create','store']]);
		$this->middleware('permission:language-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:language-delete', ['only' => ['destroy']]);
	}

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Language::query();
            $data->orderBy('id', 'DESC');
            // $data = Language::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row){
                    $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                    return $checkbox;
                })
                ->addColumn('action', function($row){
					if (Gate::check('language-edit')) {
                        $edit = '<a href="'.route('admin.setting.languages.edit', $row->id).'" class="btn btn-sm btn-success mb-0 px-2" title="'.__('core::core.form.edit-button').'" data-toggle="tooltip">
                                        <i class="material-icons text-sm">edit</i>
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('language-delete')) {
                        $delete = '<button class="remove btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.setting.languages.trash').'" title="'.__('core::core.form.trash-button').'" data-toggle="tooltip">
										<i class="material-icons text-sm">delete</i>
									</button>';
                    }else{
                        $delete = '';
                    }


                    $action = $edit.' '.$delete;

                    return $action;
                })

                ->addColumn('status', function($row){

                	if ($row->status == "Active") {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}

                    $status = "
                            <input type='checkbox' id='status_$row->id' id='language-$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";

                    return $status;
                })

                ->addColumn('default', function($row){

                	if ($row->default == "Active") {
                		$current_default = 'Checked';
                	}else{
                		$current_default = '';
                	}

                    $default = "
                            <input type='checkbox' id='default_$row->id' id='language-$row->id' class='check' onclick='changeDefault(event.target, $row->id);' " .$current_default. ">
							<label for='default_$row->id' class='checktoggle'>checkbox</label>
                    ";

                    return $default;
                })

                ->rawColumns(['action'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }

        $trashes = Language::onlyTrashed();
        return view('language::language.index', compact('trashes'));

	}
	public function trashes(Request $request)
	{
		if ($request->ajax()) {
            $data = Language::onlyTrashed();
            $data->orderBy('id', 'DESC');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function($row){
                $checkbox = '<input type="checkbox" class="sub_chk" data-id="'.$row->id.'">';
                return $checkbox;
            })
            ->addColumn('action', function($row){
                if (Gate::check('language-delete')) {
                    $restore = '<button class="restore btn btn-sm btn-secondary mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.setting.languages.restore').'" title="'.__('core::core.form.restore-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">restore</i>
                                </button>';
                }else{
                    $restore = '';
                }

                if (Gate::check('language-delete')) {
                    $delete = '<button class="force_destroy btn btn-sm btn-danger mb-0 px-2" data-id="'.$row->id.'" data-action="'.route('admin.setting.languages.force_destroy').'" title="'.__('core::core.form.delete-button').'" data-toggle="tooltip">
                                    <i class="material-icons text-sm">delete_forever</i>
                                </button>';
                }else{
                    $delete = '';
                }

                $action = $restore.' '.$delete;
                return $action;
            })

            ->addColumn('status', function($row){

                if ($row->status == "Active") {
                    $current_status = 'Checked';
                }else{
                    $current_status = '';
                }

                $status = "
                        <input type='checkbox' id='status_$row->id' id='language-$row->id' class='check' onclick='changeStatus(event.target, $row->id);' " .$current_status. ">
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                ";

                return $status;
            })

            ->addColumn('default', function($row){

                if ($row->default == "Active") {
                    $current_default = 'Checked';
                }else{
                    $current_default = '';
                }

                $default = "
                        <input type='checkbox' id='default_$row->id' id='language-$row->id' class='check' onclick='changeDefault(event.target, $row->id);' " .$current_default. ">
                        <label for='default_$row->id' class='checktoggle'>checkbox</label>
                ";

                return $default;
            })


            ->rawColumns(['action'])

            ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
            ->escapeColumns([])
            ->make(true);
        }

        $trashes = Language::onlyTrashed();
        return view('language::language.trashes', compact('trashes'));
	}

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('language::language.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreLanguageRequest $request)
	{
        DB::beginTransaction();
        if(!isset($request['default'])){
            $request['default'] = 'Inactive';
        }else{
            $request['default'] = 'Active';
        }

        if ($request['default'] == 'Active') {
            $check_defaults = Language::where('default', 'Active')->get();
            if($check_defaults != null){
                foreach($check_defaults as $check_default){
                    $set_all_default_to_inactive = Language::find($check_default->id)->update(['default' => 'Inactive']);
                }
            }
        }

		try {
			Language::create([
                'name'              => $request->input('name'),
                'code'              => $request->input('code'),
                'default'           => $request->input('default'),
            ]);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.setting.languages.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg = __('core::core.message.success.store');
        return redirect()->route('admin.setting.languages.index')->with('success',$success_msg);
	}


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('language::language.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $language = Language::find($id);
        return view('language::language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateLanguageRequest $request, $id)
	{
        DB::beginTransaction();
		$input = $request->all();

        if(!isset($request['default'])){
            $input['default'] = 'Inactive';
        }else{
            $input['default'] = 'Active';
        }

        if ($input['default'] == 'Active') {
            $check_defaults = Language::where('default', 'Active')->get();
            if($check_defaults != null){
                foreach($check_defaults as $check_default){
                    $set_all_default_to_inactive = Language::find($check_default->id)->update(['default' => 'Inactive']);
                }
            }
        }
		$language = Language::find($id);

		try {
			$language->update($input);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.setting.languages.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg = __('core::core.message.success.update');
        return redirect()->route('admin.setting.languages.index')->with('success',$success_msg);

	}

    public function status_update(Request $request)
	{

        $current_status = Language::find($request->id);

        if ($current_status->default == 'Active') {

            $error_msg = __('core::core.message.default_not_change');
            return response()->json(['danger'=> $error_msg]);
        }else{
            $status = Language::find($request->id)->update(['status' => $request->status]);
            $success_msg = __('core::core.message.success.update');
            return response()->json(['success'=> $success_msg]);
        }



	}

    public function default_update(Request $request)
	{
		$current_status = Language::find($request->id);

        if ($current_status->default== 'Inactive') {
            $check_defaults = Language::where('default', 'Active')->get();
            if($check_defaults != null){
                foreach($check_defaults as $check_default){
                    $set_all_default_to_inactive = Language::find($check_default->id)->update(['default' => 'Inactive']);
                }
            }
        }elseif($current_status->default == 'Active'){

            if($current_status->code == 'en'){
                $warning = __('core::core.message.warning');
                return response()->json(['warning'=> $warning]);
            }


            $check_active_defaults = Language::where('default', 'Active')->where('id', '!=', $request->id)->first();

            if($check_active_defaults == null || empty($check_active_defaults)){
                $set_english_as_default = Language::where('code', 'en')->update(['default' => 'Active']);
            }
        }



		$status = Language::find($request->id)->update(['default' => $request->default_status]);
        \Session::put('locale',$current_status->code);

        $code = "$current_status->code";
        $set_env = $this->putPermanentEnv('APP_LOCALE', $code);
        Artisan::call('optimize');

        $default = __('core::core.message.default');
        return response()->json(['success'=> $default]);
	}

    public function putPermanentEnv($key, $value)
    {

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key.'='.config('app.locale'), $key.'='.$value, file_get_contents($path)
            ));
        }

    }






	public function trash()
	{
        DB::beginTransaction();

		$id                 = request()->input('id');

		try {
            Language::find($id)->delete();
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
                Language::find($id)->delete();
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
            Language::onlyTrashed()->find($id)->forceDelete();
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg  = __('core::core.message.error');
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
                $permission = Language::find($id);
                if ($permission) {
                    $permission->forceDelete();
                }else{
                    Language::onlyTrashed()->find($id)->forceDelete();
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
            Language::onlyTrashed()->find($id)->restore();
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
                Language::onlyTrashed()->find($id)->restore();
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
