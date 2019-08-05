<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('common_name_id')->unsigned();
            $table->foreign('common_name_id')->references('id')->on('common_names');
            $table->integer('certificate_id')->unsigned();
            $table->foreign('certificate_id')->references('id')->on('certificates');
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
        Schema::dropIfExists('current_certificates');
    }
}
