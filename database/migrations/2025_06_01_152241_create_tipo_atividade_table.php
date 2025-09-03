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
        Schema::create('tipo_atividades', function (Blueprint $table) {
            $table->id();
            $table->string('atividade');
            $table->string('limite_horas');
            $table->unsignedBigInteger('ppc_id');
            $table->foreign('ppc_id')->references('id')->on('ppcs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_atividades');
    }
};
