@extends('adminlte::page')

@section('title', 'Adicionar Aluguel')

@section('content_header')
    <h1>Adicionar Aluguel</h1>
@stop

@section('content')
    <form action="{{ route('alugueis.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="console_id">Console</label>
            <select class="form-control" id="console_id" name="console_id" required onchange="updatePrice()">
                <option value="">Selecione um Console</option>
                @foreach ($consoles as $console)
                    <option value="{{ $console->id }}" data-preco="{{ $console->preco_por_hora }}">{{ $console->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select class="form-control" id="cliente_id" name="cliente_id" required>
                <option value="">Selecione um Cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="data_hora_inicio">Hora de Início</label>
            <input type="datetime-local" class="form-control" id="data_hora_inicio" name="data_hora_inicio"
                value="{{ old('data_hora_inicio') }}" required onchange="calculateTotal()">
        </div>
        <div class="form-group">
            <label for="data_hora_fim">Hora de Fim</label>
            <input type="datetime-local" class="form-control" id="data_hora_fim" name="data_hora_fim"
                value="{{ old('data_hora_fim') }}" onchange="calculateTotal()">
        </div>
        <div class="form-group">
            <label for="valor_total">Preço Total</label>
            <input type="number" step="0.01" class="form-control" id="valor_total" name="valor_total"
                value="{{ old('valor_total') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('alugueis.index') }}" class="btn btn-default">Voltar</a>
    </form>

    <script>
        function updatePrice() {
            const consoleSelect = document.getElementById('console_id');
            const selectedOption = consoleSelect.options[consoleSelect.selectedIndex];
            const precoPorHora = parseFloat(selectedOption.dataset.preco);
            const valorTotalInput = document.getElementById('valor_total');
            valorTotalInput.value = precoPorHora || 0;
        }

        function calculateTotal() {
            const consoleSelect = document.getElementById('console_id');
            const selectedOption = consoleSelect.options[consoleSelect.selectedIndex];
            const precoPorHora = parseFloat(selectedOption.dataset.preco);
            const dataHoraInicio = new Date(document.getElementById('data_hora_inicio').value);
            const dataHoraFim = new Date(document.getElementById('data_hora_fim').value);

            if (dataHoraInicio && dataHoraFim && dataHoraFim > dataHoraInicio) {
                const diffHours = (dataHoraFim - dataHoraInicio) / (1000 * 60 * 60);
                const total = diffHours * precoPorHora;
                document.getElementById('valor_total').value = total.toFixed(2);
            }
        }
    </script>
@stop
