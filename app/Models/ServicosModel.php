<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicosModel extends Model
{
    protected $table = 'tblservicos';

    protected $primaryKey = 'idServico';

    protected $fillable = [
        'tipoServico',
        'nomeServico',
        'duracaoServico',
        'descricaoServico',
        'valorServico',
        'idFuncionario' // Adicione esta linha se ainda não estiver presente
    ];

      const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'idFuncionario', 'idFuncionario');
    }
}


