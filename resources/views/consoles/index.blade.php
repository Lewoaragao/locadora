@extends('adminlte::page')

@section('title', 'Consoles')

@section('content_header')
    <h1>Consoles</h1>
@stop

@section('content')
    <a href="{{ route('consoles.create') }}" class="btn btn-primary mb-3">Adicionar Console</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Plataforma</th>
                <th>Preço por Hora</th>
                <th>Disponibilidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consoles as $console)
                <tr>
                    <td>{{ $console->id }}</td>
                    <td>{{ $console->nome }}</td>
                    <td>{{ $console->plataforma }}</td>
                    <td>R$ {{ $console->preco_por_hora }}</td>
                    <td>{{ $console->disponibilidade }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('consoles.show', $console->id) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('consoles.edit', $console->id) }}" class="btn btn-warning">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $console->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <form id="delete-form-{{ $console->id }}" action="{{ route('consoles.destroy', $console->id) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $consoles->links() }}
@stop

@section('js')
    <script>
        function confirmDelete(id) {
            if (confirm('Tem certeza que deseja deletar este console?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@stop
