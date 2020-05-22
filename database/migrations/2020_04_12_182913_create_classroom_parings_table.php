<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomParingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_parings', function (Blueprint $table) {
            $table->id('par_id');
            $table->foreignId('cls_id');
            $table->foreignId('user_id');
            $table->foreignId('usr_paring');
            $table->string('par_status');
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
        Schema::dropIfExists('classroom_parings');
    }
}
