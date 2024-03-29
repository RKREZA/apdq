<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('subscriptions')) {
            Schema::create('subscriptions', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();

                $table->enum('option_ad_free', ['Inactive', 'Active'])->default('Inactive');
                $table->enum('option_live_content', ['Inactive', 'Active'])->default('Inactive');
                $table->enum('option_premium_content', ['Inactive', 'Active'])->default('Inactive');

                $table->string('duration');
                $table->enum('duration_type', ['Day(s)', 'Month(s)', 'Year(s)'])->default('Day(s)');
                $table->string('price');

                $table->string('trial_days');

                $table->string('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                $table->text('seo_keyword')->nullable();

                $table->enum('status', ['Inactive', 'Active'])->default('Active');
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('subscriptions');
    }
}
