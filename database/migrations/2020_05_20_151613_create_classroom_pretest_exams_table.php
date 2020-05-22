<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomPretestExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_pretest_exams', function (Blueprint $table) {
            $table->id('exm_id');
            $table->foreignId('pt_id');
            $table->foreignId('cls_id');
            $table->text('exm_question');
            $table->text('exm_choice_1');
            $table->text('exm_choice_2');
            $table->text('exm_choice_3');
            $table->text('exm_choice_4');
            $table->string('exm_answer');
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
        Schema::dropIfExists('classroom_pretest_exams');
    }
}
