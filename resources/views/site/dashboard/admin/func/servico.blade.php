
@extends('site.dashboard.dashboardLayout.layout')

@section('dash-func')
    <h4>Serviços do Salão LeFlower</h4>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista de Serviços</h4>
                <div class="table-responsive">
                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($servicos as $servico)
                            <tr>
                                <td>{{ $servico->tipoServico }}</td>
                                <td>{{ $servico->nomeServico }}</td>
                                <td>{{ $servico->descricaoServico }}</td>
                                <td>{{ $servico->valorServico }}</td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection



