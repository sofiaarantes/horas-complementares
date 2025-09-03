<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('img', 255);
            $table->string('titulo', 255);
            $table->float('total_horas');
            $table->unsignedBigInteger('tipo_atividade_id');
            $table->foreign('tipo_atividade_id')->references('id')->on('tipo_atividades')->onDelete('cascade');
            $table->unsignedBigInteger('submissao_id');
            $table->foreign('submissao_id')->references('id')->on('submissao')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};
