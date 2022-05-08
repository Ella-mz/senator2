<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // edit posts
            $table->string('slug'); //edit-posts
            $table->boolean('show')->default(1); // for separating un-deletable permissions from others
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // edit posts
            $table->string('slug'); //edit-posts
            $table->boolean('show')->default(1);// for separating un-deletable roles from others
            $table->boolean('editPermission')->default(0);
            $table->boolean('active')->default(1);
//            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedbigInteger('role_id');
            $table->unsignedbigInteger('permission_id');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onDelete('NO ACTION')->onUpdate('NO ACTION');

            //SETTING THE PRIMARY KEYS
            $table->primary(['role_id', 'permission_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('role_id');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            //SETTING THE PRIMARY KEYS
            $table->primary(['user_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
    }
}
