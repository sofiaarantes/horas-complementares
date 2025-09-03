<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
     protected $fillable = [
        'img',
        'titulo',
        'total_horas',
        'tipo_atividade_id',
        'submissao_id',
    ];

    public function tipoAtividade()
    {
        return $this->belongsTo(TipoAtividade::class);
    }

    public function submissao()
    {
        return $this->belongsTo(Submissao::class);
    }
}
