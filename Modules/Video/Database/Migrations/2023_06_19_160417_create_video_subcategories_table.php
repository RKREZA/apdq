<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('video_subcategories')) {
            Schema::create('video_subcategories', function (Blueprint $table) {
                $table->id();
                $table->string('serial')->nullable();
                $table->string('name')->nullable();
                $table->string('code')->unique();
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
        Schema::dropIfExists('video_subcategories');
    }
}
