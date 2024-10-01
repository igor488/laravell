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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laboratorio_id'); // Foreign key para Laboratórios
            $table->unsignedBigInteger('periodo_id'); // Foreign key para Periodos
            $table->unsignedBigInteger('horario_id'); // Foreign key para Horarios
            $table->json('aulas');
            $table->timestamps();

              // Relacionamentos
        $table->foreign('laboratorio_id')->references('id')->on('laboratorios')->onDelete('cascade');
        $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
        $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');
               

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
