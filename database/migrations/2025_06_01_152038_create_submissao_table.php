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
        Schema::create('submissao', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_submissao');
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado']);
            $table->dateTime('data_avaliacao')->nullable();
            $table->integer('soma_horas');
            $table->unsignedBigInteger('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('avaliador_id')->nullable();
            $table->foreign('avaliador_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissao');
    }
};
