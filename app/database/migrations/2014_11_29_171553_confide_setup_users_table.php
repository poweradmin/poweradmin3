<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfideSetupUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Creates the users table
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('status', 'confirmed');
            $table->string('confirmation_code')->after('remember_token');
        });

        // Creates password reminders table
        Schema::create('password_reminders', function (Blueprint $table) {
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('password_reminders');

        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('confirmation_code');
            $table->renameColumn('confirmed', 'status');
        });
    }
}
