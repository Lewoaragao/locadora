@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Bem-vindo à Locadora de Videogames</h3>
                    </div>

                    <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="mb-0">Sobre Nós</h3>
                            </div>
                            <div class="card-body">
                                <p>Na nossa locadora, você pode alugar os melhores consoles de videogame por hora. Temos uma
                                    ampla variedade de consoles para atender a todos os gostos!</p>
                                <p>Oferecemos um ambiente seguro e confortável para você se divertir com seus amigos.</p>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="mb-0">Consoles Disponíveis</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($consoles as $console)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $console->nome }}
                                            <span class="badge badge-primary badge-pill">R$
                                                {{ number_format($console->preco_por_hora, 2, ',', '.') }} por hora</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="mb-0">Agendar Aluguel</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('alugueis.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="console_id">Console</label>
                                        <select class="form-control" id="console_id" name="console_id" required>
                                            <option value="">Selecione um Console</option>
                                            @foreach ($consoles as $console)
                                                <option value="{{ $console->id }}"
                                                    data-preco="{{ $console->preco_por_hora }}">
                                                    {{ $console->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cliente_id">Cliente</label>
                                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome"
                                            required placeholder="Seu Nome">
                                    </div>
                                    <div class="form-group">
                                        <label for="data_hora_inicio">Hora de Início</label>
                                        <input type="datetime-local" class="form-control" id="data_hora_inicio"
                                            name="data_hora_inicio" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="data_hora_fim">Hora de Fim</label>
                                        <input type="datetime-local" class="form-control" id="data_hora_fim"
                                            name="data_hora_fim" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="valor_total">Preço Total</label>
                                        <input type="number" step="0.01" class="form-control" id="valor_total"
                                            name="valor_total" required readonly>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Agendar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('console_id').addEventListener('change', function() {
            const precoPorHora = this.options[this.selectedIndex].dataset.preco;
            const horaInicio = document.getElementById('data_hora_inicio');
            const horaFim = document.getElementById('data_hora_fim');

            const calculateTotal = () => {
                const inicio = new Date(horaInicio.value);
                const fim = new Date(horaFim.value);
                if (inicio && fim && fim > inicio) {
                    const diffHours = (fim - inicio) / (1000 * 60 * 60);
                    document.getElementById('valor_total').value = (diffHours * precoPorHora).toFixed(2);
                }
            };

            horaInicio.addEventListener('change', calculateTotal);
            horaFim.addEventListener('change', calculateTotal);
        });
    </script>
@endsection
