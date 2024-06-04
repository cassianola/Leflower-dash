<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'tblclientes';
    protected $primaryKey = 'idCliente';

    protected $fillable = [
        'nomeCliente',
        'telefoneCliente',
        'emailCliente',
        'senhaCliente',
        'idFuncionario' // Adicione esta linha se ainda não estiver presente
    ];


    // public function usuario(){
    //     return $this->morphOne(Usuario::class, 'tipo_usuario');
    // }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'idFuncionario', 'idFuncionario');
    }

}





// ***************

// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class ServicosModel extends Model
// {
//     protected $table = 'tblservicos';

//     protected $primaryKey = 'idServico';

//     protected $fillable = [
//         'tipoServico',
//         'nomeServico',
//         'duracaoServico',
//         'descricaoServico',
//         'valorServico',
//         'idFuncionario' // Adicione esta linha se ainda não estiver presente
//     ];

//     public function funcionario()
//     {
//         return $this->belongsTo(Funcionario::class, 'idFuncionario', 'idFuncionario');
//     }
// }


