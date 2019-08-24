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
            $table->bigIncrements('id');
            $table->datetime('expiration_date')->nullable()->default(null);
            $table->string('csr')->nullable(true)->default(null);
            $table->string('cacert')->nullable(true)->default(null);
            $table->string('crt')->nullable(true)->default(null);
            $table->string('key')->nullable(true)->default(null);
            $table->string('save_dir_path')->nullable(true)->default(null);
            $table->unsignedBigInteger('certificate_service_id')->nullable(true);
            $table->foreign('certificate_service_id')->references('id')->on('certificate_services')->onDelete('set null');
            $table->unsignedBigInteger('commonname_id')->nullable(true);
            $table->foreign('commonname_id')->references('id')->on('commonnames')->onDelete('set null');        
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
