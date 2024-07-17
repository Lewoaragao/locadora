@extends('adminlte::page')

@section('title', 'Visualizar Cliente')

@section('content_header')
    <h1>Visualizar Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $cliente->nome }}</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $cliente->id }}</p>
            <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>

            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $cliente->id }})">
                Deletar
            </button>

            <form id="delete-form-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>


@stop

@section('js')
    <script>
        function confirmDelete(id) {
            if (confirm('Tem certeza que deseja deletar este cliente?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@stop
