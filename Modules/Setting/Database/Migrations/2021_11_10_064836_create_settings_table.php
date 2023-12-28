<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();

                $table->text('logo_dark')->nullable();
                $table->text('logo_light')->nullable();
                $table->text('favicon')->nullable();


                $table->text('meta_image')->nullable();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->string('social_title')->nullable();
                $table->text('social_description')->nullable();

                $table->enum('preloader_status', ['Inactive', 'Active'])->default('Inactive');

                $table->enum('back_to_top_status', ['Inactive', 'Active'])->default('Active');



                $table->enum('google_login', ['Inactive', 'Active'])->default('Active');
                $table->text('google_client_id')->nullable();
                $table->text('google_client_secret')->nullable();
                $table->text('google_redirect')->nullable();
                $table->text('google_recaptcha_v3_site_key')->nullable();
                $table->text('google_recaptcha_v3_secret_key')->nullable();
                $table->text('google_adsense_publisher_id')->nullable();
                $table->text('google_youtube_api_key')->nullable();

                $table->enum('facebook_login', ['Inactive', 'Active'])->default('Active');
                $table->text('facebook_app_id')->nullable();
                $table->text('facebook_client_secret')->nullable();
                $table->text('facebook_redirect')->nullable();

                $table->text('gdpr_cookie_title')->nullable();
                $table->text('gdpr_cookie_text')->nullable();
                $table->text('gdpr_cookie_url')->nullable();



                $table->string('copyright')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
