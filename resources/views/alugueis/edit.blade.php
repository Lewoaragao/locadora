@extends('adminlte::page')

@section('title', 'Editar Aluguel')

@section('content_header')
    <h1>Editar Aluguel</h1>
@stop

@section('content')
    <form action="{{ route('alugueis.update', $aluguel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="console_id">Console</label>
            <select class="form-control" id="console_id" name="console_id" required>
                @foreach ($consoles as $console)
                    <option value="{{ $console->id }}" @if ($console->id == $aluguel->console_id) selected @endif>
                        {{ $console->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select class="form-control" id="cliente_id" name="cliente_id" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" @if ($cliente->id == $aluguel->cliente_id) selected @endif>
                        {{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="data_hora_inicio">Hora de Início</label>
            <input type="datetime-local" class="form-control" id="data_hora_inicio" name="data_hora_inicio"
                value="{{ $aluguel->data_hora_inicio }}" required>
        </div>

        <div class="form-group">
            <label for="data_hora_fim">Hora de Fim</label>
            <input type="datetime-local" class="form-control" id="data_hora_fim" name="data_hora_fim"
                value="{{ $aluguel->data_hora_fim }}">
        </div>

        <div class="form-group">
            <label for="valor_total">Preço Total</label>
            <input type="number" step="0.01" class="form-control" id="valor_total" name="valor_total"
                value="{{ $aluguel->valor_total }}" required>
        </div>

        <x-botao-submit text="Editar" />
        <x-botao-voltar route="alugueis.index" />
    </form>
@stop
