<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sliders')) {
            Schema::create('sliders', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('url')->nullable();
                $table->text('description')->nullable();

                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('slider_categories')->onDelete('set null');

                $table->bigInteger('video_id')->unsigned()->nullable();
                $table->foreign('video_id')->references('id')->on('videos')->onDelete('set null');

                $table->bigInteger('live_id')->unsigned()->nullable();
                $table->foreign('live_id')->references('id')->on('lives')->onDelete('set null');

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
        Schema::dropIfExists('sliders');
    }
}
