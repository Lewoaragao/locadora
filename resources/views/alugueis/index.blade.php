@extends('adminlte::page')

@section('title', 'Aluguéis')

@section('content_header')
    <h1>Aluguéis</h1>
@stop

@section('content')
    <a href="{{ route('alugueis.create') }}" class="btn btn-primary mb-3">Adicionar Aluguel</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Console</th>
                <th>Cliente</th>
                <th>Hora de Início</th>
                <th>Hora de Fim</th>
                <th>Preço Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alugueis as $aluguel)
                <tr>
                    <td>{{ $aluguel->id }}</td>
                    <td>{{ $aluguel->console->nome }}</td>
                    <td>{{ $aluguel->cliente->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($aluguel->data_hora_inicio)->format('d/m/Y H:i') }}</td>
                    <td>{{ $aluguel->data_hora_fim ? \Carbon\Carbon::parse($aluguel->data_hora_fim)->format('d/m/Y H:i') : '' }}
                    </td>

                    <td>{{ $aluguel->valor_total }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('alugueis.show', $aluguel->id) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('alugueis.edit', $aluguel->id) }}" class="btn btn-warning">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $aluguel->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <form id="delete-form-{{ $aluguel->id }}" action="{{ route('alugueis.destroy', $aluguel->id) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $alugueis->links() }}
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
