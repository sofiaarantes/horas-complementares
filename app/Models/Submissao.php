<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submissao extends Model
{
    protected $table = 'submissao';
    protected $fillable = [
        'data_submissao',
        'status',
        'data_avaliacao',
        'soma_horas',
        'aluno_id',
        'avaliador_id',
    ];

    public function aluno()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function avaliador()
    {
        return $this->belongsTo(User::class, 'avaliador_id');
    }

    public function certificados()
    {
        return $this->hasMany(\App\Models\Certificado::class, 'submissao_id');
    }
}
