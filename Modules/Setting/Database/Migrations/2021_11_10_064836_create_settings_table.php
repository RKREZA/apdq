<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();

                $table->text('logo_dark')->nullable();
                $table->text('logo_light')->nullable();
                $table->text('favicon')->nullable();


                $table->text('meta_image')->nullable();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->string('social_title')->nullable();
                $table->text('social_description')->nullable();

                $table->enum('preloader_status', ['Inactive', 'Active'])->default('Inactive');

                $table->enum('back_to_top_status', ['Inactive', 'Active'])->default('Active');

                $table->string('copyright')->nullable();

                $table->timestamps();
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
        Schema::dropIfExists('settings');
    }
}
