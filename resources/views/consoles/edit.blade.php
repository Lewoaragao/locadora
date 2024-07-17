@extends('adminlte::page')

@section('title', 'Editar Console')

@section('content_header')
    <h1>Editar Console</h1>
@stop

@section('content')
    <form action="{{ route('consoles.update', $console->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $console->nome }}" required>
        </div>
        <div class="form-group">
            <label for="plataforma">Plataforma</label>
            <input type="text" class="form-control" id="plataforma" name="plataforma" value="{{ $console->plataforma }}"
                required>
        </div>
        <div class="form-group">
            <label for="preco_por_hora">Preço por Hora</label>
            <input type="number" step="0.01" class="form-control" id="preco_por_hora" name="preco_por_hora"
                value="{{ $console->preco_por_hora }}" required>
        </div>
        <div class="form-group">
            <label for="disponibilidade">Disponibilidade</label>
            <input type="number" class="form-control" id="disponibilidade" name="disponibilidade"
                value="{{ $console->disponibilidade }}" required>
        </div>

        <x-botao-submit text="Editar" />
        <x-botao-voltar route="consoles.index" />
    </form>
@stop
