
@extends('site.dashboard.dashboardLayout.layout')

@section('dash-func')
    <h4>Clientes do Salão LeFlower</h4>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista de Clientes</h4>
                <div class="table-responsive">
                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Email</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nomeCliente }}</td>
                                <td>{{ $cliente->telefoneCliente }}</td>
                                <td>{{ $cliente->emailCliente }}</td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection



