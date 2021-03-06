<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('section', function(Blueprint $table)
        {
            $table->increments('section_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('section__user', function(Blueprint $table)
        {
            $table->increments('section_user_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('user_id');
            $table->foreign('section_id')->references('section_id')->on('section')->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete("cascade")->onUpdate("cascade");
        });

        Schema::create('section__admin', function(Blueprint $table)
        {
            $table->increments('section_admin_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('user_id');
            $table->foreign('section_id')->references('section_id')->on('section')->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section__user', function($table) {
            $table->dropForeign("section__user_section_id_foreign");
            $table->dropForeign("section__user_user_id_foreign");
        });
        Schema::table('section__admin', function($table) {
            $table->dropForeign("section__admin_section_id_foreign");
            $table->dropForeign("section__admin_user_id_foreign");
        });
        Schema::drop('section');
        Schema::drop('section__user');
        Schema::drop('section__admin');
    }

}
