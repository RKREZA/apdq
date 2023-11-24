<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('frontend_settings')) {
            Schema::create('frontend_settings', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();

                $table->text('logo_light')->nullable();
                $table->text('logo_dark')->nullable();
                $table->text('favicon')->nullable();


                $table->text('meta_image')->nullable();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->string('social_title')->nullable();
                $table->text('social_description')->nullable();
                $table->enum('preloader_status', ['Inactive', 'Active'])->default('Inactive');
                $table->string('copyright')->nullable();

                $table->integer('hit')->nullable();

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
        Schema::dropIfExists('frontend_settings');
    }
}
