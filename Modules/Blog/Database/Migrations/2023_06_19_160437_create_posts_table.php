<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description');
                $table->text('tag');

                $table->string('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                $table->text('seo_keyword')->nullable();

                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('post_categories')->onDelete('set null');
                $table->enum('status', ['Inactive', 'Active'])->default('Active');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('post_comments')) {
            Schema::create('post_comments', function (Blueprint $table) {
                $table->increments('id');

                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

                $table->bigInteger('post_id')->unsigned()->nullable();
                $table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');

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
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_comments');
    }
}
