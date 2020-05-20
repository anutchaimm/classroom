<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_contents', function (Blueprint $table) {
            $table->id('con_id');
            $table->foreignId('cls_id');
            $table->foreignId('user_id');
            $table->longText('con_content');
            $table->string('con_file')->nullable();
            $table->string('con_originalname')->nullable();
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
        Schema::dropIfExists('classroom_contents');
    }
}
