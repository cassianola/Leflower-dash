<!-- resources/views/site/dashboard/admin/servico/createServico.blade.php -->
@extends('site.dashboard.dashboardLayout.layout')

@section('dash-func')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            width: 93%;
            margin: auto;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="datetime-local"],
        select {
            width: calc(100% - 20px);
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .invalid-feedback {
            color: #ff0000;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

    <!-- Parte do formulário -->
    <form action="{{ route('dashboard.admin.func.servico.cad') }}" method="POST">
        @csrf
        <div>
            <label for="tipoServico">Tipo de Serviço:</label>
            <input type="text" id="tipoServico" name="tipoServico" required>
        </div>
        <div>
            <label for="nomeServico">Nome do Serviço:</label>
            <input type="text" id="nomeServico" name="nomeServico">
        </div>
        <div>
            <label for="duracaoServico">Duração do Serviço (hh:mm):</label>
            <input type="time" id="duracaoServico" name="duracaoServico" required>
        </div>
        <div>
            <label for="descricaoServico">Descrição do Serviço:</label>
            <textarea id="descricaoServico" name="descricaoServico"></textarea>
        </div>
        <div>
            <label for="valorServico">Valor do Serviço:</label>
            <input type="text" id="valorServico" name="valorServico" required>
        </div>
        <button type="submit">Salvar</button>
    </form>
@endsection
