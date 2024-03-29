<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('videos')) {
            Schema::create('videos', function (Blueprint $table) {
                $table->id();
                $table->enum('video_type', ['youtube', 'manual'])->default('manual');
                $table->enum('publish_type', ['publish', 'schedule'])->default('publish');
                $table->enum('content_type', ['paid', 'free'])->default('free');

                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->text('tag')->nullable();

                $table->text('embed_html')->nullable();
                $table->string('thumbnail_url')->nullable();
                $table->string('external_id')->nullable();

                $table->string('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                $table->text('seo_keyword')->nullable();

                $table->integer('like')->nullable()->default(0);
                $table->integer('love')->nullable()->default(0);
                $table->integer('haha')->nullable()->default(0);
                $table->integer('wow')->nullable()->default(0);
                $table->integer('sad')->nullable()->default(0);
                $table->integer('angry')->nullable()->default(0);
                $table->integer('dislike')->nullable()->default(0);

                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('video_categories')->onDelete('set null');

                $table->bigInteger('subcategory_id')->unsigned()->nullable();
                $table->foreign('subcategory_id')->references('id')->on('video_subcategories')->onDelete('set null');

                $table->bigInteger('playlist_id')->unsigned()->nullable();
                $table->foreign('playlist_id')->references('id')->on('video_playlists')->onDelete('set null');
                $table->enum('status', ['Inactive', 'Active'])->default('Active');
                $table->enum('featured', ['Inactive', 'Active'])->default('Inactive');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('video_comments')) {
            Schema::create('video_comments', function (Blueprint $table) {
                $table->increments('id');

                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

                $table->bigInteger('video_id')->unsigned()->nullable();
                $table->foreign('video_id')->references('id')->on('videos')->onDelete('set null');

                $table->integer('parent_id')->unsigned()->nullable();
                $table->text('body');
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
        Schema::dropIfExists('videos');
        Schema::dropIfExists('video_comments');
    }
}
