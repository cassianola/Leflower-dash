<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use App\Models\ServicosModel;
use Illuminate\Http\Request;

// perfil do admin/atualizar
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


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

        return view('site.dashboard.admin.func.servico.servico', compact('servico'));

        // return view('site.dashboard.admin.func.servico', compact('func', 'servicos'));
    }


    public function indexFuncCliente()
    {
        $clientes = DB::table('tblclientes')->get(); // Buscar todos os serviços

        return view('site.dashboard.admin.func.cliente', compact('clientes'));

        // return view('site.dashboard.admin.func.servico', compact('func', 'servicos'));
    }






    // Exibir perfil do admin

    public function perfilFunc()
    {
        Log::info('Perfil do admin acessado');
        $idFuncionario = session('id');
        Log::info('ID do Funcionario da Sessão: ' . $idFuncionario);

        if (!$idFuncionario) {
            Log::error('ID do funcionário não encontrado na sessão');
            return redirect()->back()->with('error', 'ID do funcionário não encontrado na sessão.');
        }

        $func = Funcionario::find($idFuncionario);

        if (!$func) {
            Log::error('Funcionário não encontrado com ID: ' . $idFuncionario);
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        return view('site.dashboard.admin.func.perfil', compact('func'));
    }


    public function updateFunc(Request $request)
    {
        Log::info('Update profile request received', ['request' => $request->all()]);

        $idFuncionario = session('id');
        Log::info('ID do Funcionario da Sessão: ' . $idFuncionario);

        if (!$idFuncionario) {
            Log::error('ID do funcionário não encontrado na sessão');
            return redirect()->back()->with('error', 'ID do funcionário não encontrado na sessão.');
        }

        $func = Funcionario::find($idFuncionario);

        if (!$func) {
            Log::error('Funcionário não encontrado com ID: ' . $idFuncionario);
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        Log::info('Funcionário encontrado', ['funcionario' => $func]);

        try {
            $validatedData = $request->validate([
                'nomeFuncionario' => 'required|string|max:255',
                'dataNascFuncionario' => 'required|date',
                'emailFuncionario' => 'required|string|email|max:255',
                'telefoneFuncionario' => 'required|string|max:15',
                'enderecoFuncionario' => 'required|string|max:255',
                'senhaFuncionario' => 'nullable|string|confirmed|min:2',
                'salarioFuncionario' => 'required|numeric',
                'nivelFuncionario' => 'required|string|max:255',
                'statusFuncionario' => 'required|string|max:255',
                'cargoFuncionario' => 'required|string|max:255',
                'idEspecialidade' => 'required|integer',
            ]);

            Log::info('Validation passed', ['validatedData' => $validatedData]);

            $func->nomeFuncionario = $validatedData['nomeFuncionario'];
            $func->dataNascFuncionario = $validatedData['dataNascFuncionario'];
            $func->emailFuncionario = $validatedData['emailFuncionario'];
            $func->telefoneFuncionario = $validatedData['telefoneFuncionario'];
            $func->enderecoFuncionario = $validatedData['enderecoFuncionario'];
            $func->salarioFuncionario = $validatedData['salarioFuncionario'];
            $func->nivelFuncionario = $validatedData['nivelFuncionario'];
            $func->statusFuncionario = $validatedData['statusFuncionario'];
            $func->cargoFuncionario = $validatedData['cargoFuncionario'];
            $func->idEspecialidade = $validatedData['idEspecialidade'];

            if (!empty($validatedData['senhaFuncionario'])) {
                Log::info('Password field is filled');
                $func->senhaFuncionario = Hash::make($validatedData['senhaFuncionario']);
                Log::info('Senha criptografada: ' . $func->senhaFuncionario);
            } else {
                Log::info('Password field is not filled');
            }

            Log::info('Saving updated data to database');
            $func->save();

            Log::info('Profile updated successfully for ID: ' . $idFuncionario);

            return redirect()->route('dashboard.admin.func.perfil')->with('success', 'Perfil atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Error updating profile', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erro ao atualizar perfil.');
        }
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









// criar servico

public function createServico()
{
    // Verifica se o usuário está autenticado
    $servicos = session('id');

    // Busca o serviço no banco de dados
    $servico = ServicosModel::find($servicos);

    // Se o serviço não for encontrado, retorna erro 404
    if (!$servico) {
        abort(404, 'Servico nao encontrado');
    }

    // Retorna a view com os dados do serviço
    return view('site.dashboard.admin.func.servico.createServico', compact('servicos'));
}


    public function cadServico(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'tipoServico' => 'required|string|max:40',
            'nomeServico' => 'nullable|string|max:50',
            'duracaoServico' => 'required|string|max:5', // Ajustado para string e limite de caracteres
            'descricaoServico' => 'nullable|string',
            'valorServico' => 'required|string|max:40',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',

        ]);



        $servico = new ServicosModel();

        $servico->tipoServico = $request->input('tipoServico');
        $servico->nomeServico = $request->input('nomeServico');
        $servico->duracaoServico = $request->input('duracaoServico');
        $servico->descricaoServico = $request->input('descricaoServico');
        $servico->valorServico = $request->input('valorServico');
        $servico->created_at = $request->input('created_at');
        $servico->updated_at = $request->input('updated_at');


        $servico->save();

        return redirect()->route('dashboard.admin.func.servico.servico')->with('success', 'Servico cadastrado com sucesso');
    }
}
