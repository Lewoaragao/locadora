@extends('adminlte::page')

@section('title', 'Adicionar Console')

@section('content_header')
    <h1>Adicionar Console</h1>
@stop

@section('content')
    <form action="{{ route('consoles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="form-group">
            <label for="plataforma">Plataforma</label>
            <input type="text" class="form-control" id="plataforma" name="plataforma" value="{{ old('plataforma') }}"
                required>
        </div>
        <div class="form-group">
            <label for="preco_por_hora">Preço por Hora</label>
            <input type="number" step="0.01" class="form-control" id="preco_por_hora" name="preco_por_hora"
                value="{{ old('preco_por_hora') }}" required>
        </div>
        <div class="form-group">
            <label for="disponibilidade">Disponibilidade</label>
            <input type="number" class="form-control" id="disponibilidade" name="disponibilidade"
                value="{{ old('disponibilidade') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@stop
