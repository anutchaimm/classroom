<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_divisions', function (Blueprint $table) {
            $table->id('div_id');
            $table->foreignId('cls_id');
            $table->string('div_name');
            $table->longText('div_role')->nullable();
            $table->tinyInteger('div_win');
            $table->tinyInteger('div_draw');
            $table->tinyInteger('div_lose');
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
        Schema::dropIfExists('classroom_divisions');
    }
}
