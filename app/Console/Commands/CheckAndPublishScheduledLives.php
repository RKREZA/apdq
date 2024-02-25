<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Live\Entities\Live;
use Carbon\Carbon;

class CheckAndPublishScheduledLives extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lives:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and publish scheduled lives if the scheduled time has passed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();

        Live::where('publish_type', 'schedule')
            ->where('created_at', '<=', $now)
            ->update(['publish_type' => 'publish']);

        $this->info('Scheduled videos have been published successfully.');

        return 0;
    }
}
