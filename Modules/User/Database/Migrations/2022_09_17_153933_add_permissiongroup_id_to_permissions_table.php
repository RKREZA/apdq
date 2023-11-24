<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissiongroupIdToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('permissions', 'permissiongroup_id')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->bigInteger('permissiongroup_id')->unsigned()->nullable()->after('guard_name');
                $table->foreign('permissiongroup_id')->references('id')->on('permission_groups')->onDelete('set null');
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
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
}
