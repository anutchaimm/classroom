<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomDivisionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_division_users', function (Blueprint $table) {
            $table->id('divu_id');
            $table->foreignId('div_id');
            $table->foreignId('cls_id');
            $table->foreignId('user_id');
            $table->tinyInteger('div_usr_total_match');
            $table->tinyInteger('div_usr_total_win');
            $table->tinyInteger('div_usr_total_draw');
            $table->tinyInteger('div_usr_total_lose');
            $table->Integer('div_usr_total_point');
            $table->tinyInteger('div_usr_rank')->nullable();
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
        Schema::dropIfExists('classroom_division_users');
    }
}
