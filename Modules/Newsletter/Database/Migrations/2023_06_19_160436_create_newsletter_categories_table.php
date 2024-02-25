<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('newsletter_categories')) {
            Schema::create('newsletter_categories', function (Blueprint $table) {
                $table->id();
                $table->string('serial')->nullable();
                $table->string('name');
                $table->string('code')->unique();
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
        Schema::dropIfExists('newsletter_categories');
    }
}
