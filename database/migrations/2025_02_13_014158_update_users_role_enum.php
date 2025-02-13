<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersRoleEnum extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'super-admin', 'user') NOT NULL DEFAULT 'user'");
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'user') NOT NULL DEFAULT 'user'");
        });
    }
};