<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('file_post')) {
            Schema::create('file_post', function (Blueprint $table) {

                $table->bigInteger('post_id')->unsigned();
                $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

                $table->bigInteger('file_id')->unsigned();
                $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');

                $table->primary(['file_id','post_id'],'file_post_primary');

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
        Schema::dropIfExists('file_post');
    }
}
