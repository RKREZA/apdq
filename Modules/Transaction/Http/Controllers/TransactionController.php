<?php

namespace Modules\Transaction\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Transaction\Entities\Transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Modules\Transaction\DataTables\TransactionsDataTable;
use Modules\Transaction\DataTables\TransactionTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubeVideo;

class TransactionController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:transaction-list', ['only' => ['index']]);
		$this->middleware('permission:transaction-create', ['only' => ['create','store']]);
		$this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:transaction-view', ['only' => ['view']]);
		$this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
	}

    public function index(TransactionsDataTable $dataTable)
    {
        return $dataTable->render('transaction::transaction.index');
    }
    public function trashes(TransactionTrashesDataTable $dataTable)
    {
        return $dataTable->render('transaction::transaction.trashes');
    }

    // public function create()
    // {
    //     return view('transaction::transaction.create');
    // }

    public function store(Request $request)
    {
        $rules = [
            'email' 					=> 'required',
			'payment_amount' 			=> 'required|string',
			'transaction_id' 			=> 'required|string',
			'subscription_id' 			=> 'required|string',
			'user_id' 			        => 'required|string',
			'paymentgateway_id' 	    => 'nullable|string'
        ];

        $messages = [
            'email.required'    		=> __('core::core.form.validation.required'),
            'payment_amount.required'   => __('core::core.form.validation.required'),
            'transaction_id.required'   => __('core::core.form.validation.required'),
            'subscription_id.required'  => __('core::core.form.validation.required'),
            'user_id.required'          => __('core::core.form.validation.required'),
            'paymentgateway_id.required'=> __('core::core.form.validation.required')
        ];

        $validate = $this->validate($request, $rules, $messages);

        DB::beginTransaction();

		try {
			Transaction::create([
                'email'                 => $request->input('email'),
                'payment_amount'        => $request->input('payment_amount'),
                'transaction_id'        => $request->input('transaction_id'),
                'subscription_id'       => $request->input('subscription_id'),
                'user_id'               => $request->input('user_id'),
                'paymentgateway_id'     => $request->input('paymentgateway_id')
            ]);

            $success_msg        = __('core::core.message.success.update');
            return response()->json(['success'=> $success_msg]);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg  = __('core::core.message.error');
            return response()->json(['error'=>$error_msg]);
		}
        DB::commit();
    }

    // public function edit($id)
    // {
    //     $transaction = Transaction::find($id);
    //     return view('transaction::transaction.edit', compact('transaction'));
    // }

    // public function update(Request $request, $id)
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


    //     DB::beginTransaction();
	// 	try {
    //         $input       = $request->all();
    //         $transaction         = Transaction::find($id);
	// 		$transaction->update($input);

	// 	} catch (Exception $e) {
    //         DB::rollBack();
	// 		$error_msg      = __('core::core.message.error');
	// 		return redirect()->route('admin.transactions.index')->with('error',$error_msg);
	// 	}
    //     DB::commit();
    //     $success_msg    = __('core::core.message.success.update');
    //     return redirect()->route('admin.transactions.index')->with('success',$success_msg);

    // }

    public function view($id)
    {
        $transaction = Transaction::find($id);
        return view('transaction::transaction.view', compact('transaction'));
    }

	// public function status_update(Request $request)
	// {
    //     DB::beginTransaction();
    //     try {
	// 	    Transaction::find($request->id)->update(['status' => $request->status]);
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $error_msg  = __('core::core.message.error');
    //         return response()->json(['error'=>$error_msg]);
    //     }
    //     DB::commit();
    //     $success_msg        = __('core::core.message.success.update');
    //     return response()->json(['success'=> $success_msg]);

	// }

	// public function trash()
	// {
    //     DB::beginTransaction();

	// 	$id                 = request()->input('id');
	// 	try {
    //         Transaction::find($id)->delete();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $error_msg  = __('core::core.message.error');
    //         return response()->json(['error'=>$error_msg]);
    //     }
    //     DB::commit();
    //     $success_msg = __('core::core.message.success.trash');
    //     return response()->json(['success'=>$success_msg]);

	// }

    // public function trash_all(Request $request)
    // {
    //     $ids                = explode(",",$request->ids);

    //     DB::beginTransaction();
    //     foreach($ids as $id){
    //         try {
    //             Transaction::find($id)->delete();
    //         } catch (Exception $e) {
    //             DB::rollBack();
    //             $error_msg = __('core::core.message.error');
    //             return response()->json(['error'=>$error_msg]);
    //         }
    //     }
    //     DB::commit();
    //     $success_msg = __('core::core.message.success.trash');
    //     return response()->json(['success'=>$success_msg]);
    // }

	// public function force_destroy()
	// {
    //     DB::beginTransaction();

	// 	$id                 = request()->input('id');

	// 	try {
    //         $transaction = Transaction::find($id);
    //         if ($transaction) {
    //             $transaction->forceDelete();
    //         }else{
    //             transaction::onlyTrashed()->find($id)->forceDelete();
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $error_msg = __('core::core.message.error');
    //         return response()->json(['error'=>$error_msg]);
    //     }

    //     DB::commit();
    //     $success_msg = __('core::core.message.success.destroy');
    //     return response()->json(['success'=>$success_msg]);

	// }

    // public function force_destroy_all(Request $request)
    // {
    //     $ids                = explode(",",$request->ids);

    //     DB::beginTransaction();
    //     foreach($ids as $id){
    //         try {
    //             $transaction = Transaction::find($id);
    //             if ($transaction) {
    //                 $transaction->forceDelete();
    //             }else{
    //                 Transaction::onlyTrashed()->find($id)->forceDelete();
    //             }
    //         } catch (Exception $e) {
    //             DB::rollBack();
    //             $error_msg = __('core::core.message.error');
    //             return response()->json(['error'=>$error_msg]);
    //         }
    //     }
    //     DB::commit();
    //     $success_msg = __('core::core.message.success.destroy');
    //     return response()->json(['success'=>$success_msg]);
    // }

	// public function restore()
	// {
    //     DB::beginTransaction();

	// 	$id                 = request()->input('id');

	// 	try {
    //         Transaction::onlyTrashed()->find($id)->restore();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $error_msg  = __('core::core.message.error');
    //         return response()->json(['error'=>$error_msg]);
    //     }
    //     DB::commit();
    //     $success_msg = __('core::core.message.success.restore');
    //     return response()->json(['success'=>$success_msg]);

	// }

    // public function restore_all(Request $request)
	// {
    //     $ids                = explode(",",$request->ids);
    //     DB::beginTransaction();

	// 	$id                 = request()->input('id');

	// 	try {
    //         foreach ($ids as $id) {
    //             Transaction::onlyTrashed()->find($id)->restore();
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         $error_msg  = __('core::core.message.error');
    //         return response()->json(['error'=>$error_msg]);
    //     }
    //     DB::commit();
    //     $success_msg = __('core::core.message.success.restore');
    //     return response()->json(['success'=>$success_msg]);

	// }


}
