<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZoneTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('zone_template_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id')->unsigned();
            $table->string('name');
            $table->string('type', 6);
            $table->string('content');
            $table->integer('ttl');
            $table->integer('priority');
            $table->timestamps();

            $table->foreign('template_id')->references('id')->on('zone_templates')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zone_templates');
        Schema::drop('zone_template_records');
    }
}
