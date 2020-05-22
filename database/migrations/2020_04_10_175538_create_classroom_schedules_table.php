<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_schedules', function (Blueprint $table) {
            $table->id('scd_id');
            $table->foreignId('div_id');
            $table->tinyInteger('com_week');
            $table->date('com_date', 0);
            $table->foreignId('com_user1');
            $table->tinyInteger('com_scoreuser1');
            $table->foreignId('com_user2');
            $table->tinyInteger('com_scoreuser2');
            $table->string('com_result');
            $table->string('com_status');
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
        Schema::dropIfExists('classroom_schedules');
    }
}
