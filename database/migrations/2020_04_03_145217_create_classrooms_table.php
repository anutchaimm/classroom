<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {

            $table->id('cls_id');
            $table->foreignId('user_id');
            $table->string('cls_code');
            $table->string('cls_name');
            $table->string('cls_img')->nullable();
            $table->string('cls_subject')->nullable();
            $table->tinyInteger('cls_term');
            $table->string('cls_duration')->nullable();
            $table->string('cls_level')->nullable();
            $table->tinyInteger('cls_type');
            $table->tinyInteger('cls_status')->nullable();
            $table->unsignedBigInteger('cls_setting')->nullable();
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
        Schema::dropIfExists('classrooms');
    }
}
