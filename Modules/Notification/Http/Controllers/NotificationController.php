<?php

namespace Modules\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Beneficiary\Entities\Beneficiary;
use Modules\CompletionReport\Entities\CompletionReport;
use Modules\DemandLetter\Entities\DemandLetter;
use Modules\FrontEndManager\Entities\Gallery;
use Modules\FrontEndManager\Entities\SuccessStory;
use Modules\FundAllocation\Entities\FundAllocation;
use Modules\News\Entities\News;
use Modules\Notice\Entities\Notice;
use Modules\User\Entities\User;
use Notification;

use Modules\Notice\Notifications\NoticeNotification;
use Modules\ProgressReport\Entities\ProgressReport;
use Modules\ProjectForm\Entities\ProjectFormCategory;
use Modules\ProjectForm\Entities\ProjectFormCategoryOrganogram;
use Modules\ProjectProfile\Entities\ProjectProfile;
use Modules\Publication\Entities\Publication;
use Modules\Upload\Entities\Upload;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
	{
        $counter = 0;
        $authorizations = [];
        $demandletter_authorization = [];
        $fundallocation_authorization = [];
        $progressreport_authorization = [];
        $completionreport_authorization = [];
        $newses = [];
        $notices = [];
        $publications = [];
        $uploads = [];
        $projectprofiles = [];
        $beneficiaries = [];
        $galleries = [];
        $successstories = [];

        // Demandletter
        $demandletters = \Modules\DemandLetter\Entities\DemandLetter::get();

        if(!empty($demandletters)){
            foreach ($demandletters as $key => $demandletter) {
                $project_form_category              = \Modules\ProjectForm\Entities\ProjectFormCategory::where('code', 'demand_letter')->first();
                $project_form_category_organograms  = \Modules\ProjectForm\Entities\ProjectFormCategoryOrganogram::where('project_form_category_id', $project_form_category->id)->get();
                $unauthorized_roles                 = array_diff($project_form_category_organograms->pluck('role_id')->toArray(), $demandletter->authorize_role->pluck('id')->toArray());
                $current_user_role                  = auth()->user()->roles->pluck('id')->toArray();
                if(in_array($current_user_role[0], $unauthorized_roles)){
                    $demandletter_authorization[] = $demandletter;
                }
            }
            $counter = $counter+count($demandletter_authorization);
        }


        // FundAllocation
        $fundallocations = \Modules\FundAllocation\Entities\FundAllocation::get();

        if(!empty($fundallocations)){
            foreach ($fundallocations as $key => $fundallocation) {
                $project_form_category              = \Modules\ProjectForm\Entities\ProjectFormCategory::where('code', 'allocation_of_money')->first();
                $project_form_category_organograms  = \Modules\ProjectForm\Entities\ProjectFormCategoryOrganogram::where('project_form_category_id', $project_form_category->id)->get();
                $unauthorized_roles                 = array_diff($project_form_category_organograms->pluck('role_id')->toArray(), $fundallocation->authorize_role->pluck('id')->toArray());
                $current_user_role                  = auth()->user()->roles->pluck('id')->toArray();
                if(in_array($current_user_role[0], $unauthorized_roles)){
                    $fundallocation_authorization[] = $fundallocation;
                }
            }
            $counter = $counter+count($fundallocation_authorization);
        }

        // ProgressReport
        $progressreports = \Modules\ProgressReport\Entities\ProgressReport::get();

        if(!empty($progressreports)){
            foreach ($progressreports as $key => $progressreport) {
                $project_form_category              = \Modules\ProjectForm\Entities\ProjectFormCategory::where('code', 'progress_report')->first();
                $project_form_category_organograms  = \Modules\ProjectForm\Entities\ProjectFormCategoryOrganogram::where('project_form_category_id', $project_form_category->id)->get();
                $unauthorized_roles                 = array_diff($project_form_category_organograms->pluck('role_id')->toArray(), $progressreport->authorize_role->pluck('id')->toArray());
                $current_user_role                  = auth()->user()->roles->pluck('id')->toArray();
                if(in_array($current_user_role[0], $unauthorized_roles)){
                    $progressreport_authorization[] = $progressreport;
                }
            }
            $counter = $counter+count($progressreport_authorization);
        }

        // CompletionReport
        $completionreports = \Modules\CompletionReport\Entities\CompletionReport::get();
        if(!empty($completionreports)){
            foreach ($completionreports as $key => $completionreport) {
                $project_form_category              = \Modules\ProjectForm\Entities\ProjectFormCategory::where('code', 'completion_report')->first();
                $project_form_category_organograms  = \Modules\ProjectForm\Entities\ProjectFormCategoryOrganogram::where('project_form_category_id', $project_form_category->id)->get();
                $unauthorized_roles                 = array_diff($project_form_category_organograms->pluck('role_id')->toArray(), $completionreport->authorize_role->pluck('id')->toArray());
                $current_user_role                  = auth()->user()->roles->pluck('id')->toArray();
                if(in_array($current_user_role[0], $unauthorized_roles)){
                    $completionreport_authorization[] = $completionreport;
                }
            }
            $counter = $counter+count($completionreport_authorization);
        }

        if (auth()->user()->department->code == 'administrator') {
            // News
            $newses = \Modules\News\Entities\News::where('status','Inactive')->get();
            $counter = $counter+count($newses);

            // Notice
            $notices = \Modules\Notice\Entities\Notice::where('status','Inactive')->get();
            $counter = $counter+count($notices);

            // Publication
            $publications = \Modules\Publication\Entities\Publication::where('status','Inactive')->get();
            $counter = $counter+count($publications);

            // Upload
            $uploads = \Modules\Upload\Entities\Upload::where('status','Inactive')->get();
            $counter = $counter+count($uploads);

            // ProjectProfile
            $projectprofiles = \Modules\ProjectProfile\Entities\ProjectProfile::where('status','Inactive')->get();
            $counter = $counter+count($projectprofiles);

            // Beneficiary
            $beneficiaries = \Modules\Beneficiary\Entities\Beneficiary::where('status','Inactive')->get();
            $counter = $counter+count($beneficiaries);

            // Gallery
            $galleries = \Modules\FrontEndManager\Entities\Gallery::where('status','Inactive')->get();
            $counter = $counter+count($galleries);

            // SuccessStory
            $successstories = \Modules\FrontEndManager\Entities\SuccessStory::where('status','Inactive')->get();
            $counter = $counter+count($successstories);
        }



        return view('notification::notification.index', compact(
            'demandletter_authorization',
            'fundallocation_authorization',
            'progressreport_authorization',
            'completionreport_authorization',
            'newses',
            'notices',
            'publications',
            'uploads',
            'projectprofiles',
            'beneficiaries',
            'galleries',
            'successstories'
        ));
	}

    public function mark_as_read(Request $request)
	{
        $notification       = auth()->user()->unreadNotifications;
        $notification->markAsRead();
        $success_msg        = __('notification::notification.message.mark_as_read.success');
		return redirect()->route('admin.notifications.index')->with('success',$success_msg);

	}

    // public function sendNotification($data) {
    //     $userSchema = User::first();
    //     $data = [
    //         'title'         => $data['title'],
    //         'action'        => $data['action'],
    //         'description'   => $data['description'],
    //         'thanks'        => $data['thanks'],
    //         'text'          => $data['text'],
    //         'url'           => url($data['url']),
    //         'id'            => $data['id']
    //     ];

    //     Notification::send($userSchema, new NoticeNotification($data));
    // }
}
