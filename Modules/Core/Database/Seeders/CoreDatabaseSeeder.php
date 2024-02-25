<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(FeedbackCategoryTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(FrontendSettingTableSeeder::class);
        $this->call(FaqCategoryTableSeeder::class);
        $this->call(VideoCategoryTableSeeder::class);
        $this->call(VideoSubcategoryTableSeeder::class);
        $this->call(VideoPlaylistTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(PostCategoryTableSeeder::class);
        $this->call(PostSubcategoryTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PaymentGatewayTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(SubscriptionTableSeeder::class);
        $this->call(NewsletterCategoryTableSeeder::class);
    }
}
