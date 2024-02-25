<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('post_subcategories')) {
            Schema::create('post_subcategories', function (Blueprint $table) {
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
        Schema::dropIfExists('post_subcategories');
    }
}
