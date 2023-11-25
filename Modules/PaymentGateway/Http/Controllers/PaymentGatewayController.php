<?php

namespace Modules\PaymentGateway\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\PaymentGateway\Entities\PaymentGateway;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Modules\PaymentGateway\DataTables\PaymentGatewaysDataTable;
use Modules\PaymentGateway\DataTables\PaymentGatewayTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubeVideo;

class PaymentGatewayController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:paymentgateway-list', ['only' => ['index']]);
		$this->middleware('permission:paymentgateway-create', ['only' => ['create','store']]);
		$this->middleware('permission:paymentgateway-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:paymentgateway-view', ['only' => ['view']]);
		$this->middleware('permission:paymentgateway-delete', ['only' => ['destroy']]);
	}

    public function index(PaymentGatewaysDataTable $dataTable)
    {
        return $dataTable->render('paymentgateway::paymentgateway.index');
    }
    public function trashes(PaymentGatewayTrashesDataTable $dataTable)
    {
        return $dataTable->render('paymentgateway::paymentgateway.trashes');
    }

    public function create()
    {
        return view('paymentgateway::paymentgateway.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'title' 					=> 'required',
			'description' 			    => 'required|string',
			'duration' 			        => 'required|string',
			'duration_type' 			=> 'required|string',
			'price' 			        => 'required|string',
			'seo_title' 			    => 'nullable|string',
			'seo_description' 		    => 'nullable|string',
			'seo_keyword' 			    => 'nullable|string'
        ];

        $messages = [
            'title.required'    		=> __('core::core.form.validation.required'),
            'description.required'      => __('core::core.form.validation.required'),
            'duration.required'         => __('core::core.form.validation.required'),
            'duration_type.required'    => __('core::core.form.validation.required'),
            'price.required'            => __('core::core.form.validation.required'),
            'seo_title.required'        => __('core::core.form.validation.required'),
            'seo_description.required'  => __('core::core.form.validation.required'),
            'seo_keyword.required'      => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);
        // dd($request->all());
		try {
			PaymentGateway::create([
                'title'         => $request->input('title'),
                'description'   => $request->input('description'),
                'duration'      => $request->input('duration'),
                'duration_type' => $request->input('duration_type'),
                'price'         => $request->input('price'),
                'seo_title'     => $request->input('seo_title'),
                'seo_description'=> $request->input('seo_description'),
                'seo_keyword'   => $request->input('seo_keyword')
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.paymentgateways.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.paymentgateways.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $paymentgateway = PaymentGateway::find($id);
        $info = json_decode($paymentgateway->info);
        // dd($info->mode);
        return view('paymentgateway::paymentgateway.edit', compact('paymentgateway','info'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
			'name' 			    => 'required|string'
        ];

        $messages = [
            'name.required'    		=> __('core::core.form.validation.required')
        ];

        $validate = $this->validate($request, $rules, $messages);

        $paymentgateway     = PaymentGateway::find($id);
        $input              = $request->all();
        $input['info']      = null;

        if($paymentgateway->code == 'paypal'){
            $input['info']  = json_encode([
                'mode'              => $request->mode,
                'paypal_client_id'  => $request->paypal_client_id,
                'paypal_secret'     => $request->paypal_secret,
            ]);
        }

        DB::beginTransaction();
		try {
			$paymentgateway->update($input);
		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.paymentgateways.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.paymentgateways.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $paymentgateway = PaymentGateway::find($id);
        return view('paymentgateway::paymentgateway.view', compact('paymentgateway'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    PaymentGateway::find($request->id)->update(['status' => $request->status]);
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
            PaymentGateway::find($id)->delete();
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
                PaymentGateway::find($id)->delete();
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
            $paymentgateway = PaymentGateway::find($id);
            if ($paymentgateway) {
                $paymentgateway->forceDelete();
            }else{
                PaymentGateway::onlyTrashed()->find($id)->forceDelete();
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
                $paymentgateway = PaymentGateway::find($id);
                if ($paymentgateway) {
                    $paymentgateway->forceDelete();
                }else{
                    PaymentGateway::onlyTrashed()->find($id)->forceDelete();
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
            PaymentGateway::onlyTrashed()->find($id)->restore();
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
                PaymentGateway::onlyTrashed()->find($id)->restore();
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
