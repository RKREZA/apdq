<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('lives')) {
            Schema::create('lives', function (Blueprint $table) {
                $table->id();
                $table->enum('publish_type', ['publish', 'schedule'])->default('publish');
                $table->enum('content_type', ['paid', 'free'])->default('free');
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description');
                $table->string('live_url');

                $table->text('embed_html');
                $table->string('thumbnail_url');
                $table->string('external_id');

                $table->string('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                $table->text('seo_keyword')->nullable();

                $table->enum('status', ['Inactive', 'Active'])->default('Active');
                $table->enum('archive', ['Inactive', 'Active'])->default('Inactive');
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
        Schema::dropIfExists('lives');
    }
}
