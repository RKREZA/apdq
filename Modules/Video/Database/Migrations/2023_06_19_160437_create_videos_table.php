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
        Schema::dropIfExists('videos');
    }
}
