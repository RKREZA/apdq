<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Live\Entities\Live;
use App\Jobs\SendLiveNotificationEmails;
use Carbon\Carbon;

class SendLiveNotificationsCommand extends Command
{
    protected $signature = 'lives:send-notifications';
    protected $description = 'Send notifications for live events';

    public function handle()
    {
        $liveEvents = Live::where('created_at', '<=', Carbon::now())
                           ->get();

        foreach ($liveEvents as $liveEvent) {
            dispatch(new SendLiveNotificationEmails($liveEvent));
        }
    }
}
