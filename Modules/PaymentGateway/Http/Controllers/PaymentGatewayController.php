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
use Dotenv\Dotenv;
use Illuminate\Support\Facades\Artisan;

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

    // public function create()
    // {
    //     return view('paymentgateway::paymentgateway.create');
    // }

    // public function store(Request $request)
    // {
    //     $rules = [
    //         'title' 					=> 'required',
	// 		'description' 			    => 'required|string',
	// 		'duration' 			        => 'required|string',
	// 		'duration_type' 			=> 'required|string',
	// 		'price' 			        => 'required|string',
	// 		'seo_title' 			    => 'nullable|string',
	// 		'seo_description' 		    => 'nullable|string',
	// 		'seo_keyword' 			    => 'nullable|string'
    //     ];

    //     $messages = [
    //         'title.required'    		=> __('core::core.form.validation.required'),
    //         'description.required'      => __('core::core.form.validation.required'),
    //         'duration.required'         => __('core::core.form.validation.required'),
    //         'duration_type.required'    => __('core::core.form.validation.required'),
    //         'price.required'            => __('core::core.form.validation.required'),
    //         'seo_title.required'        => __('core::core.form.validation.required'),
    //         'seo_description.required'  => __('core::core.form.validation.required'),
    //         'seo_keyword.required'      => __('core::core.form.validation.required'),
    //     ];

    //     $validate = $this->validate($request, $rules, $messages);
	// 	try {
	// 		PaymentGateway::create([
    //             'title'         => $request->input('title'),
    //             'description'   => $request->input('description'),
    //             'duration'      => $request->input('duration'),
    //             'duration_type' => $request->input('duration_type'),
    //             'price'         => $request->input('price'),
    //             'seo_title'     => $request->input('seo_title'),
    //             'seo_description'=> $request->input('seo_description'),
    //             'seo_keyword'   => $request->input('seo_keyword')
    //         ]);

	// 		$success_msg = __('core::core.message.success.store');
	// 		return redirect()->route('admin.paymentgateways.index')->with('success',$success_msg);

	// 	} catch (Exception $e) {
	// 		$error_msg = __('core::core.message.error');
	// 		return redirect()->route('admin.paymentgateways.index')->with('error',$error_msg);
	// 	}
    // }

    public function edit($id)
    {
        $paymentgateway = PaymentGateway::find($id);
        $info = json_decode($paymentgateway->info);
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

        $input['info']      = null;
        $input['name']      = $request->name;

        if($request->code == 'paypal'){
            $input['info']  = json_encode([
                'mode'                      => $request->mode,
                'currency'                  => $request->currency,
                'sandbox_paypal_client_id'  => $request->sandbox_paypal_client_id,
                'sandbox_paypal_secret'     => $request->sandbox_paypal_secret,
                'live_paypal_client_id'     => $request->live_paypal_client_id,
                'live_paypal_secret'        => $request->live_paypal_secret,
            ]);
        }

        if($request->code == 'stripe'){
            $input['info']  = json_encode([
                'mode'                      => $request->mode,
                'currency'                  => $request->currency,
                'sandbox_stripe_key'        => $request->sandbox_stripe_key,
                'sandbox_stripe_secret'     => $request->sandbox_stripe_secret,
                'live_stripe_key'           => $request->live_stripe_key,
                'live_stripe_secret'        => $request->live_stripe_secret,
            ]);
        }

		try {
            $paymentgateway     = PaymentGateway::find($id);
			$paymentgateway->update($input);

            // Update the .env file
            if($request->code == 'paypal'){
                $this->updateEnv([
                    'PAYPAL_MODE'                   => $request->mode,
                    'PAYPAL_CURRENCY'               => $request->currency,

                    'PAYPAL_SANDBOX_CLIENT_ID'      => $request->sandbox_paypal_client_id,
                    'PAYPAL_SANDBOX_CLIENT_SECRET'  => $request->sandbox_paypal_secret,

                    'PAYPAL_LIVE_CLIENT_ID'         => $request->live_paypal_client_id,
                    'PAYPAL_LIVE_CLIENT_SECRET'     => $request->live_paypal_secret,
                ]);
            }

            // Update the .env file
            if($request->code == 'stripe'){
                $this->updateEnv([
                    'STRIPE_MODE'                   => $request->mode,
                    'STRIPE_CURRENCY'               => $request->currency,

                    'STRIPE_SANDBOX_KEY'            => $request->sandbox_stripe_key,
                    'STRIPE_SANDBOX_SECRET'         => $request->sandbox_stripe_secret,

                    'STRIPE_LIVE_KEY'               => $request->live_stripe_key,
                    'STRIPE_LIVE_SECRET'            => $request->live_stripe_secret,
                ]);
            }
		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.paymentgateways.index')->with('error',$error_msg);
		}
        
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.paymentgateways.index')->with('success',$success_msg);

    }

    protected function updateEnv(array $data)
    {
        // Update .env file using config helper
        

        if(isset($data['PAYPAL_MODE'])){
            config([
                'paypal.mode'                   => $data['PAYPAL_MODE'],
                'paypal.currency'               => $data['PAYPAL_CURRENCY'],
                'paypal.sandbox_client_id'      => $data['PAYPAL_SANDBOX_CLIENT_ID'],
                'paypal.sandbox_client_secret'  => $data['PAYPAL_SANDBOX_CLIENT_SECRET'],
                'paypal.live_client_id'         => $data['PAYPAL_LIVE_CLIENT_ID'],
                'paypal.live_client_secret'     => $data['PAYPAL_LIVE_CLIENT_SECRET'],
            ]);
        }
        

        if(isset($data['STRIPE_MODE'])){
            config([
                'service.stripe.mode'                   => $data['STRIPE_MODE'],
                'service.stripe.currency'               => $data['STRIPE_CURRENCY'],
                'service.stripe.sandbox_client_id'      => $data['STRIPE_SANDBOX_KEY'],
                'service.stripe.sandbox_client_secret'  => $data['STRIPE_SANDBOX_SECRET'],
                'service.stripe.live_client_id'         => $data['STRIPE_LIVE_KEY'],
                'service.stripe.live_client_secret'     => $data['STRIPE_LIVE_SECRET'],
            ]);
        }

        // Save the changes to the .env file
        $this->saveEnvFile($data);

        // Reload the configuration
        Artisan::call('config:cache');
    }

    protected function saveEnvFile(array $data)
    {
        $envFile = base_path('.env');

        // Load existing environment variables
        $envData = file_get_contents($envFile);

        if(isset($data['PAYPAL_MODE'])){
            // Update specific variables
            $envData = preg_replace('/PAYPAL_MODE=(.*)/', 'PAYPAL_MODE=' . $data['PAYPAL_MODE'], $envData);
            $envData = preg_replace('/PAYPAL_CURRENCY=(.*)/', 'PAYPAL_CURRENCY=' . $data['PAYPAL_CURRENCY'], $envData);
            $envData = preg_replace('/PAYPAL_SANDBOX_CLIENT_ID=(.*)/', 'PAYPAL_SANDBOX_CLIENT_ID=' . $data['PAYPAL_SANDBOX_CLIENT_ID'], $envData);
            $envData = preg_replace('/PAYPAL_SANDBOX_CLIENT_SECRET=(.*)/', 'PAYPAL_SANDBOX_CLIENT_SECRET=' . $data['PAYPAL_SANDBOX_CLIENT_SECRET'], $envData);
            $envData = preg_replace('/PAYPAL_LIVE_CLIENT_ID=(.*)/', 'PAYPAL_LIVE_CLIENT_ID=' . $data['PAYPAL_LIVE_CLIENT_ID'], $envData);
            $envData = preg_replace('/PAYPAL_LIVE_CLIENT_SECRET=(.*)/', 'PAYPAL_LIVE_CLIENT_SECRET=' . $data['PAYPAL_LIVE_CLIENT_SECRET'], $envData);
        }
        
        if(isset($data['STRIPE_MODE'])){
            // Update specific variables
            $envData = preg_replace('/STRIPE_MODE=(.*)/', 'STRIPE_MODE=' . $data['STRIPE_MODE'], $envData);
            $envData = preg_replace('/STRIPE_CURRENCY=(.*)/', 'STRIPE_CURRENCY=' . $data['STRIPE_CURRENCY'], $envData);
            $envData = preg_replace('/STRIPE_SANDBOX_KEY=(.*)/', 'STRIPE_SANDBOX_KEY=' . $data['STRIPE_SANDBOX_KEY'], $envData);
            $envData = preg_replace('/STRIPE_SANDBOX_SECRET=(.*)/', 'STRIPE_SANDBOX_SECRET=' . $data['STRIPE_SANDBOX_SECRET'], $envData);
            $envData = preg_replace('/STRIPE_LIVE_KEY=(.*)/', 'STRIPE_LIVE_KEY=' . $data['STRIPE_LIVE_KEY'], $envData);
            $envData = preg_replace('/STRIPE_LIVE_SECRET=(.*)/', 'STRIPE_LIVE_SECRET=' . $data['STRIPE_LIVE_SECRET'], $envData);
        }

        // Save the changes
        file_put_contents($envFile, $envData);
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
