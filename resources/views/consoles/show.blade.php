@extends('adminlte::page')

@section('title', 'Visualizar Console')

@section('content_header')
    <h1>Visualizar Console</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Console #{{ $console->id }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Nome:</strong> {{ $console->nome }}</p>
            <p><strong>Plataforma:</strong> {{ $console->plataforma }}</p>
            <p><strong>Preço por Hora:</strong> R$ {{ $console->preco_por_hora }}</p>
            <p><strong>Disponibilidade:</strong> {{ $console->disponibilidade }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('consoles.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@stop
