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
            $table->bigIncrements('id');
            $table->bigInteger('commonname_id')->unsigned()->nullable(true);
            $table->foreign('commonname_id')->references('id')->on('commonnames')->onDelete('set null');
            $table->bigInteger('certificate_id')->unsigned()->nullable(true);
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('set null');
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
