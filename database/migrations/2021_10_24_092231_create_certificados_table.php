<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->integer('carga_horaria');

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('status_certificado_id')->constrained('status');
            $table->foreignId('tipo_certificado_id')->constrained('tipos_certificados');

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
        Schema::dropIfExists('certificados');
    }
}
