<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAtividade extends Model
{
    protected $fillable = [
        'atividade',
        'limite_horas',
        'ppc_id',
    ];

    public function ppc()
    {
        return $this->belongsTo(Ppc::class);
    }
}
