<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('prf_id');
            $table->unsignedBigInteger('user_id');
            $table->string('prf_imgcover')->nullable();
            $table->string('prf_img')->nullable();
            $table->string('prf_title')->nullable();
            $table->string('prf_firstname');
            $table->string('prf_lastname')->nullable();
            $table->date('prf_birthday')->nullable();
            $table->string('cty_code')->nullable();
            $table->string('crr_id')->nullable();
            $table->string('grd_id')->nullable();
            $table->longText('prf_workaddress')->nullable();
            $table->string('prf_tel')->nullable();
            $table->smallInteger('prf_status')->nullable();
            $table->string('prf_contact')->nullable();
            $table->timestamps();
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
