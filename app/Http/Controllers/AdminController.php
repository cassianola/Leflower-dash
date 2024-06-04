<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $idFuncionario = session('id');
        $func = Funcionario::find($idFuncionario);

        if (!$func) {
            abort(404, 'Funcionario não encontrado');
        }

        return view('site.dashboard.funcionarios.admin', compact('func'));
    }


    // listar os funcionarios

    public function indexFunc()
    {
        $idFuncionario = session('id');
        $func = Funcionario::find($idFuncionario);
        $listaFunc = Funcionario::all();

        return view('site.dashboard.admin.func.index', compact('func', 'listaFunc'));
    }


    // listar o serviço

    public function indexFuncServico()
    {
        $servicos = DB::table('tblservicos')->get(); // Buscar todos os serviços

        return view('site.dashboard.admin.func.servico', compact('servicos'));

        // return view('site.dashboard.admin.func.servico', compact('func', 'servicos'));
    }


    public function indexFuncCliente()
    {
        $clientes = DB::table('tblclientes')->get(); // Buscar todos os serviços

        return view('site.dashboard.admin.func.cliente', compact('clientes'));

        // return view('site.dashboard.admin.func.servico', compact('func', 'servicos'));
    }





    public function createFunc()
    {
        // Verifica se o usuário está autenticado
        $idFuncionario = session('id');

        // Busca o funcionário no banco de dados
        $func = Funcionario::find($idFuncionario);

        // Se o funcionário não for encontrado, retorna erro 404
        if (!$func) {
            abort(404, 'Funcionario nao encontrado');
        }

        // Retorna a view com os dados do funcionário
        return view('site.dashboard.admin.func.create', compact('func'));
    }

  // CADASTRAR FUNCIONARIO NOVO
  public function cadFunc(Request $request)
  {
      // Validação dos campos
      $request->validate([
          'nomeFuncionario' => 'required|string|max:100',
          'emailFuncionario' => 'required|string|max:100',
          'senhaFuncionario' => 'required|string|max:20', // Corrigido para string
          'telefoneFuncionario' => 'required|string|max:20',
          'salarioFuncionario' => 'required|numeric', // Corrigido para numeric
          'enderecoFuncionario' => 'required|string|max:100',
          'nivelFuncionario' => 'required|string|max:100',
          'cargoFuncionario' => 'required|string|max:30',
          'statusFuncionario' => 'required|string|max:20',
          'dataNascFuncionario' => 'required|date', // Adicionado
          'idEspecialidade' => 'required|integer', // Adicionado
          'created_at' => 'nullable|date',
          'updated_at' => 'nullable|date',
      ]);

      $func = new Funcionario();
    //   $user = new Usuario();
      // $user = new Usuario();

      $func->nomeFuncionario = $request->input('nomeFuncionario');
      $func->emailFuncionario = $request->input('emailFuncionario');
      $func->senhaFuncionario = $request->input('senhaFuncionario');
      $func->telefoneFuncionario = $request->input('telefoneFuncionario');
      $func->salarioFuncionario = $request->input('salarioFuncionario');
      $func->enderecoFuncionario = $request->input('enderecoFuncionario');
      $func->nivelFuncionario = $request->input('nivelFuncionario');
      $func->cargoFuncionario = $request->input('cargoFuncionario');
      $func->statusFuncionario = $request->input('statusFuncionario');
      $func->dataNascFuncionario = $request->input('dataNascFuncionario'); // Adicionado
      $func->idEspecialidade = $request->input('idEspecialidade'); // Adicionado
      $func->created_at = $request->input('created_at');
      $func->updated_at = $request->input('updated_at');


      // $user->nomeUsuario = $request->input('nomeUsuario'); // Adicionado
      // $user->senhaUsuario = $request->input('senhaUsuario'); // Adicionado
      // $user->tipoUsuario = $request->input('tipoUsuario');
      // $user->emailUsuario = $request->input('emailUsuario');
      // $user->created_at = $request->input('created_at');
      // $user->updated_at = $request->input('updated_at');
      // $user->statusUsuario = $request->input('statusUsuario');



      $func->save();

      // $funcUserId = $func->idFuncionario;

      // $user->tipoUsuario = 'funcionario';
      // $user->tipoUsuario_id = $funcUserId;
      // $user->tipoUsuario_type = 'funcionario';

      // $user->save();


      return redirect()->route('dashboard.admin.func.index')->with('sucess', 'Funcionario cadrastado com sucesso');
  }
}


