<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSslCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->integer('virtualdomain_id')->unsigned();
            $table->foreign('virtualdomain_id')->references('id')->on('virtualdomains');
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
        Schema::dropIfExists('common_names');
    }
}
