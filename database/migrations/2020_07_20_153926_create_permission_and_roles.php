<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 角色
         */
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('description',100)->default('');
            $table->timestamps();
        });

        /**
         * 权限
         */
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('description',100)->default('');
            $table->timestamps();
        });

        /**
         * 权限角色
         */
        Schema::create('admin_permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->timestamps();
        });

        /**
         * 用户角色
         */
        Schema::create('admin_role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_permission_role');
        Schema::dropIfExists('admin_role_user');
    }
}
