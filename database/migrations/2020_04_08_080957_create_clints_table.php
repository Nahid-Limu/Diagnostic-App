<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clints', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('clint_name')->nullable();
            $table->integer('clint_age')->nullable();
            $table->string('clint_sex')->nullable();
            $table->integer('clint_tel')->nullable();
            $table->string('ref_dr')->nullable();
            $table->string('clint_address')->nullable();
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
        Schema::dropIfExists('clints');
    }
}
