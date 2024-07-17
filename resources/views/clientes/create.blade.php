@extends('adminlte::page')

@section('title', 'Adicionar Cliente')

@section('content_header')
    <h1>Adicionar Cliente</h1>
@stop

@section('content')
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>

        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@stop
