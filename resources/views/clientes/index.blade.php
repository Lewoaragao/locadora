@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')

    <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Adicionar Cliente</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $cliente->id }})">
                                <i class="fa fa-trash"></i>
                            </button>

                            <form id="delete-form-{{ $cliente->id }}"
                                action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clientes->links() }}
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
