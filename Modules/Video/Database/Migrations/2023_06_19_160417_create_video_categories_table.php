<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('video_categories')) {
            Schema::create('video_categories', function (Blueprint $table) {
                $table->id();
                $table->string('serial')->nullable();
                $table->string('name')->nullable();
                $table->string('code')->unique();
                $table->string('icon')->nullable();
                $table->text('description')->nullable();
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
        Schema::dropIfExists('video_categories');
    }
}
