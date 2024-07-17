@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- Estatísticas Resumidas -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalClientes }}</h3>
                    <p>Total de Clientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('clientes.index') }}" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalConsoles }}</h3>
                    <p>Total de Consoles</p>
                </div>
                <div class="icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <a href="{{ route('consoles.index') }}" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $alugueisEmAndamento }}</h3>
                    <p>Aluguéis em Andamento</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <a href="{{ route('alugueis.index') }}" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $alugueisConcluidos }}</h3>
                    <p>Aluguéis Concluídos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
                <a href="{{ route('alugueis.index') }}" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Calendário ou Agenda -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Próximos Aluguéis</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Console</th>
                                <th>Hora de Início</th>
                                <th>Hora de Fim</th>
                                <th>Preço Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proximosAlugueis as $aluguel)
                                <tr>
                                    <td>{{ $aluguel->cliente->nome }}</td>
                                    <td>{{ $aluguel->console->nome }}</td>
                                    <td>{{ \Carbon\Carbon::parse($aluguel->data_hora_inicio)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $aluguel->data_hora_fim ? \Carbon\Carbon::parse($aluguel->data_hora_fim)->format('d/m/Y H:i') : '' }}
                                    <td>R$ {{ $aluguel->preco_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos e Relatórios -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gráfico de Aluguéis por Mês</h3>
                </div>
                <div class="card-body">
                    <canvas id="alugueisPorMes"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            // Gráfico de Aluguéis por Mês
            var ctx = document.getElementById('alugueisPorMes').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($meses) !!},
                    datasets: [{
                        label: 'Aluguéis',
                        data: {!! json_encode($alugueisPorMes) !!},
                        borderColor: 'rgba(60,141,188,0.8)',
                        backgroundColor: 'rgba(60,141,188,0.5)',
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true
                }
            });
        });
    </script>
@stop
