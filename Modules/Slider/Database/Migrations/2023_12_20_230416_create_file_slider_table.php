<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('file_slider')) {
            Schema::create('file_slider', function (Blueprint $table) {

                $table->bigInteger('slider_id')->unsigned();
                $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');

                $table->bigInteger('file_id')->unsigned();
                $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');

                $table->primary(['file_id','slider_id'],'file_slider_primary');

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
        Schema::dropIfExists('file_slider');
    }
}
