<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Entities\Post;
use Carbon\Carbon;

class CheckAndPublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and publish scheduled posts if the scheduled time has passed';

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

        Post::where('publish_type', 'schedule')
            ->where('created_at', '<=', $now)
            ->update(['publish_type' => 'publish']);

        $this->info('Scheduled posts have been published successfully.');

        return 0;
    }
}
