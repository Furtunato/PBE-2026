<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autorizacao extends Model
{
    protected $fillable = [
        'aluno_nome', 'turma', 'professor_nome',
        'responsavel_nome', 'responsavel_email', 'quem_autorizou',
        'tipo_fluxo', 'aula_referencia', 'controle_falta',
        'data_evento', 'horario',
        'status_aqv', 'status_professor', 'status_portaria'
    ];
}