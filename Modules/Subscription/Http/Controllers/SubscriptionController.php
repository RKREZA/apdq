<?php

namespace Modules\Subscription\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Subscription\Entities\Subscription;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Modules\Subscription\DataTables\SubscriptionsDataTable;
use Modules\Subscription\DataTables\SubscriptionTrashesDataTable;
use Youtube;
use Alaouy\Youtube\Rules\ValidYoutubeVideo;

class SubscriptionController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:subscription-list', ['only' => ['index']]);
		$this->middleware('permission:subscription-create', ['only' => ['create','store']]);
		$this->middleware('permission:subscription-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:subscription-view', ['only' => ['view']]);
		$this->middleware('permission:subscription-delete', ['only' => ['destroy']]);
	}

    public function index(SubscriptionsDataTable $dataTable)
    {
        return $dataTable->render('subscription::subscription.index');
    }
    public function trashes(SubscriptionTrashesDataTable $dataTable)
    {
        return $dataTable->render('subscription::subscription.trashes');
    }

    public function create()
    {
        return view('subscription::subscription.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'title' 					=> 'required',
			'option_ad_free' 			=> 'nullable|string',
			'option_live_content' 		=> 'nullable|string',
			'option_premium_content' 	=> 'nullable|string',
			'trial_days' 			    => 'nullable|string',
			'duration' 			        => 'required|string',
			'duration_type' 			=> 'required|string',
			'price' 			        => 'required|string',
			'seo_title' 			    => 'nullable|string',
			'seo_description' 		    => 'nullable|string',
			'seo_keyword' 			    => 'nullable|string'
        ];

        $messages = [
            'title.required'    		        => __('core::core.form.validation.required'),
            'trial_days.required'               => __('core::core.form.validation.required'),
            'duration.required'                 => __('core::core.form.validation.required'),
            'duration_type.required'            => __('core::core.form.validation.required'),
            'price.required'                    => __('core::core.form.validation.required'),
            'seo_title.required'                => __('core::core.form.validation.required'),
            'seo_description.required'          => __('core::core.form.validation.required'),
            'seo_keyword.required'              => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

        $input = $request->only([
            'title',
            'option_ad_free',
            'option_live_content',
            'option_premium_content',
            'trial_days',
            'duration',
            'duration_type',
            'price',
            'seo_title',
            'seo_description',
            'seo_keyword',
        ]);

        $input['option_ad_free'] = isset($input['option_ad_free']) && $input['option_ad_free'] == 'on' ? 'Active' : 'Inactive';
        $input['option_live_content'] = isset($input['option_live_content']) && $input['option_live_content'] == 'on' ? 'Active' : 'Inactive';
        $input['option_premium_content'] = isset($input['option_premium_content']) && $input['option_premium_content'] == 'on' ? 'Active' : 'Inactive';

		try {
			Subscription::create([
                'title'                     => $request->title,
                'option_ad_free'            => $request->option_ad_free,
                'option_live_content'       => $request->option_live_content,
                'option_premium_content'    => $request->option_premium_content,
                'trial_days'                => $request->trial_days,
                'duration'                  => $request->duration,
                'duration_type'             => $request->duration_type,
                'price'                     => $request->price,
                'seo_title'                 => $request->seo_title,
                'seo_description'           => $request->seo_description,
                'seo_keyword'               => $request->seo_keyword
            ]);

			$success_msg = __('core::core.message.success.store');
			return redirect()->route('admin.subscriptions.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('core::core.message.error');
			return redirect()->route('admin.subscriptions.index')->with('error',$error_msg);
		}
    }

    public function edit($id)
    {
        $subscription = Subscription::find($id);
        return view('subscription::subscription.edit', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' 					=> 'required',
			'option_ad_free' 			=> 'nullable|string',
			'option_live_content' 		=> 'nullable|string',
			'option_premium_content' 	=> 'nullable|string',
			'trial_days' 			    => 'nullable|string',
			'duration' 			        => 'required|string',
			'duration_type' 			=> 'required|string',
			'price' 			        => 'required|string',
			'seo_title' 			    => 'nullable|string',
			'seo_description' 		    => 'nullable|string',
			'seo_keyword' 			    => 'nullable|string'
        ];

        $messages = [
            'title.required'    		        => __('core::core.form.validation.required'),
            'trial_days.required'               => __('core::core.form.validation.required'),
            'duration.required'                 => __('core::core.form.validation.required'),
            'duration_type.required'            => __('core::core.form.validation.required'),
            'price.required'                    => __('core::core.form.validation.required'),
            'seo_title.required'                => __('core::core.form.validation.required'),
            'seo_description.required'          => __('core::core.form.validation.required'),
            'seo_keyword.required'              => __('core::core.form.validation.required'),
        ];

        $validate = $this->validate($request, $rules, $messages);

        $input = $request->only([
            'title',
            'option_ad_free',
            'option_live_content',
            'option_premium_content',
            'trial_days',
            'duration',
            'duration_type',
            'price',
            'seo_title',
            'seo_description',
            'seo_keyword',
        ]);

        $input['option_ad_free'] = isset($input['option_ad_free']) && $input['option_ad_free'] == 'on' ? 'Active' : 'Inactive';
        $input['option_live_content'] = isset($input['option_live_content']) && $input['option_live_content'] == 'on' ? 'Active' : 'Inactive';
        $input['option_premium_content'] = isset($input['option_premium_content']) && $input['option_premium_content'] == 'on' ? 'Active' : 'Inactive';

        DB::beginTransaction();
		try {
            $subscription           = Subscription::find($id);
			$subscription->update($input);

		} catch (Exception $e) {
            DB::rollBack();
			$error_msg      = __('core::core.message.error');
			return redirect()->route('admin.subscriptions.index')->with('error',$error_msg);
		}
        DB::commit();
        $success_msg    = __('core::core.message.success.update');
        return redirect()->route('admin.subscriptions.index')->with('success',$success_msg);

    }

    public function view($id)
    {
        $subscription = Subscription::find($id);
        return view('subscription::subscription.view', compact('subscription'));
    }

	public function status_update(Request $request)
	{
        DB::beginTransaction();
        try {
		    Subscription::find($request->id)->update(['status' => $request->status]);
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
            Subscription::find($id)->delete();
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
                Subscription::find($id)->delete();
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
            $subscription = Subscription::find($id);
            if ($subscription) {
                $subscription->forceDelete();
            }else{
                Subscription::onlyTrashed()->find($id)->forceDelete();
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
                $subscription = Subscription::find($id);
                if ($subscription) {
                    $subscription->forceDelete();
                }else{
                    Subscription::onlyTrashed()->find($id)->forceDelete();
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
            Subscription::onlyTrashed()->find($id)->restore();
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
                Subscription::onlyTrashed()->find($id)->restore();
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
