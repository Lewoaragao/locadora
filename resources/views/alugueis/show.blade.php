@extends('adminlte::page')

@section('title', 'Visualizar Aluguel')

@section('content_header')
    <h1>Visualizar Aluguel</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Aluguel #{{ $aluguel->id }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Console:</strong> {{ $aluguel->console ? $aluguel->console->nome : 'Não encontrado' }}</p>
            <p><strong>Cliente:</strong> {{ $aluguel->cliente ? $aluguel->cliente->nome : 'Não encontrado' }}</p>
            <p><strong>Hora de Início:</strong> {{ \Carbon\Carbon::parse($aluguel->data_hora_inicio)->format('d/m/Y H:i') }}
            </p>
            <p><strong>Hora de Fim:</strong>
                {{ $aluguel->data_hora_fim ? \Carbon\Carbon::parse($aluguel->data_hora_fim)->format('d/m/Y H:i') : '' }}</p>
            <p><strong>Preço Total:</strong> R$ {{ number_format($aluguel->valor_total, 2, ',', '.') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('alugueis.edit', $aluguel->id) }}" class="btn btn-warning">Editar</a>
            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $aluguel->id }})">Deletar</button>
            <form id="delete-form-{{ $aluguel->id }}" action="{{ route('alugueis.destroy', $aluguel->id) }}" method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <x-botao-voltar route="alugueis.index" />
        </div>
    </div>
@stop

@section('js')
    <script>
        function confirmDelete(id) {
            if (confirm('Tem certeza que deseja deletar este aluguel?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@stop
