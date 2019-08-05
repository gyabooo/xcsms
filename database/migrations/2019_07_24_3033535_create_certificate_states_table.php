<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('expiration_date');
            $table->string('csr');
            $table->string('cacert');
            $table->string('crt');
            $table->string('key');
            $table->string('save_dir_path');
            $table->integer('certificate_service_id')->unsigned();
            $table->foreign('certificate_service_id')->references('id')->on('certificate_services');
            $table->integer('common_name_id')->unsigned();
            $table->foreign('common_name_id')->references('id')->on('common_names');        
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
        Schema::dropIfExists('certificates');
    }
}
