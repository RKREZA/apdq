<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('file_page')) {
            Schema::create('file_page', function (Blueprint $table) {

                $table->bigInteger('page_id')->unsigned();
                $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');

                $table->bigInteger('file_id')->unsigned();
                $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');

                $table->primary(['file_id','page_id'],'file_page_primary');

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
        Schema::dropIfExists('file_page');
    }
}
