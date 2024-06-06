@extends('site.dashboard.dashboardLayout.layout')

@section('dash-func')
<div class="container">
    <h1>Perfil do Administrador</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('dashboard.admin.func.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nomeFuncionario">Nome</label>
            <input type="text" name="nomeFuncionario" id="nomeFuncionario" class="form-control" value="{{ $func->nomeFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="dataNascFuncionario">Data de Nascimento</label>
            <input type="date" name="dataNascFuncionario" id="dataNascFuncionario" class="form-control" value="{{ $func->dataNascFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="emailFuncionario">Email</label>
            <input type="email" name="emailFuncionario" id="emailFuncionario" class="form-control" value="{{ $func->emailFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="telefoneFuncionario">Telefone</label>
            <input type="text" name="telefoneFuncionario" id="telefoneFuncionario" class="form-control" value="{{ $func->telefoneFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="senhaFuncionario">Senha (mínimo 8 caracteres)</label>
            <input type="password" name="senhaFuncionario" id="senhaFuncionario" class="form-control">
        </div>

        <div class="form-group">
            <label for="senhaFuncionario_confirmation">Confirmar Senha</label>
            <input type="password" name="senhaFuncionario_confirmation" id="senhaFuncionario_confirmation" class="form-control">
        </div>

        <div class="form-group">
            <label for="salarioFuncionario">Salário</label>
            <input type="number" name="salarioFuncionario" id="salarioFuncionario" class="form-control" value="{{ $func->salarioFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="enderecoFuncionario">Endereço</label>
            <input type="text" name="enderecoFuncionario" id="enderecoFuncionario" class="form-control" value="{{ $func->enderecoFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="nivelFuncionario">Nível</label>
            <input type="text" name="nivelFuncionario" id="nivelFuncionario" class="form-control" value="{{ $func->nivelFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="statusFuncionario">Status</label>
            <input type="text" name="statusFuncionario" id="statusFuncionario" class="form-control" value="{{ $func->statusFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="cargoFuncionario">Cargo</label>
            <input type="text" name="cargoFuncionario" id="cargoFuncionario" class="form-control" value="{{ $func->cargoFuncionario }}" required>
        </div>

        <div class="form-group">
            <label for="idEspecialidade">Especialidade</label>
            <input type="number" name="idEspecialidade" id="idEspecialidade" class="form-control" value="{{ $func->idEspecialidade }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
    </form>
</div>
@endsection
