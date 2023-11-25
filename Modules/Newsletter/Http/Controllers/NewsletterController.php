<?php

namespace Modules\Newsletter\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Newsletter\Entities\Newsletter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Modules\Newsletter\DataTables\NewslettersDataTable;
use Modules\Newsletter\DataTables\NewsletterTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubeVideo;

class NewsletterController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:newsletter-list', ['only' => ['index']]);
		$this->middleware('permission:newsletter-create', ['only' => ['create','store']]);
		$this->middleware('permission:newsletter-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:newsletter-view', ['only' => ['view']]);
		$this->middleware('permission:newsletter-delete', ['only' => ['destroy']]);
	}

    public function index(NewslettersDataTable $dataTable)
    {
        return $dataTable->render('newsletter::newsletter.index');
    }
    public function trashes(NewsletterTrashesDataTable $dataTable)
    {
        return $dataTable->render('newsletter::newsletter.trashes');
    }

    public function create()
    {
        return view('newsletter::newsletter.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
			'email' 			        => 'required|email'
        ];

        $messages = [
            'email.required'    		=> __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);
        // dd($request->all());
		try {
			Newsletter::create([
                'email'         => $request->input('email')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.newsletters.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.newsletters.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $newsletter = Newsletter::find($id);
        return view('newsletter::newsletter.edit', compact('newsletter'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'email' 					=> 'required|email',
        ];

        $messages = [
            'email.required'    	=> __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);


        DB::beginTransaction();
		try {
            $input       = $request->all();
            $newsletter         = Newsletter::find($id);
			$newsletter->update($input);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.newsletters.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.newsletters.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $newsletter = Newsletter::find($id);
        return view('newsletter::newsletter.view', compact('newsletter'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Newsletter::find($request->id)->update(['status' => $request->status]);
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
            Newsletter::find($id)->delete();
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
                Newsletter::find($id)->delete();
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
            $newsletter = Newsletter::find($id);
            if ($newsletter) {
                $newsletter->forceDelete();
            }else{
                Newsletter::onlyTrashed()->find($id)->forceDelete();
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
                $newsletter = Newsletter::find($id);
                if ($newsletter) {
                    $newsletter->forceDelete();
                }else{
                    Newsletter::onlyTrashed()->find($id)->forceDelete();
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
            Newsletter::onlyTrashed()->find($id)->restore();
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
                Newsletter::onlyTrashed()->find($id)->restore();
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
