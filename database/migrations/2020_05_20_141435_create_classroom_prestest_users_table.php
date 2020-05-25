<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomPrestestUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_pretest_users', function (Blueprint $table) {
            $table->id('cpu_id');
            $table->foreignId('cls_id');
            $table->foreignId('id');
            $table->foreignId('pt_id');
            $table->integer('cpu_score');
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
        Schema::dropIfExists('classroom_prestest_users');
    }
}

