<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('autorizacaos', function (Blueprint $table) {
            $table->id();
            
            // Dados do aluno
            $table->string('aluno_nome');
            $table->string('turma');
            $table->string('professor_nome');
            
            // Dados do responsável
            $table->string('responsavel_nome');
            $table->string('responsavel_email');
            $table->string('quem_autorizou');
            
            // Configuração do fluxo
            $table->enum('tipo_fluxo', ['Entrada', 'Saída'])->default('Saída');
            $table->string('aula_referencia')->nullable();
            $table->enum('controle_falta', ['Sem Falta', 'Com Falta'])->default('Sem Falta');
            $table->date('data_evento');
            $table->time('horario');
            
            // Status do fluxo
            $table->enum('status_aqv', ['pendente', 'aprovado'])->default('pendente');
            $table->enum('status_professor', ['pendente', 'aprovado'])->default('pendente');
            $table->enum('status_portaria', ['pendente', 'liberado'])->default('pendente');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('autorizacaos');
    }
};