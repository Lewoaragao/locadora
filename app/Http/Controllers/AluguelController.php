<?php

namespace App\Http\Controllers;

use App\Models\Aluguel;
use App\Models\Console;
use App\Models\Cliente;
use Illuminate\Http\Request;

class AluguelController extends Controller
{
    public function index()
    {
        $alugueis = Aluguel::with(['console', 'cliente'])->paginate(10);
        return view('alugueis.index', compact('alugueis'));
    }

    public function create()
    {
        $consoles = Console::all();
        $clientes = Cliente::all();
        return view('alugueis.create', compact('consoles', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'console_id' => 'required|exists:consoles,id',
            'cliente_id' => 'required|exists:clientes,id',
            'data_hora_inicio' => 'required|date',
            'data_hora_fim' => 'nullable|date|after:data_hora_inicio',
            'valor_total' => 'required|numeric',
        ]);

        Aluguel::create($request->all());

        return redirect()->route('alugueis.index')->with('success', 'Aluguel criado com sucesso.');
    }

    public function show($id)
    {
        $aluguel = Aluguel::findOrFail($id);
        return view('alugueis.show', compact('aluguel'));
    }



    public function edit($id)
    {
        $aluguel = Aluguel::findOrFail($id);
        $consoles = Console::all();
        $clientes = Cliente::all();

        return view('alugueis.edit', compact('aluguel', 'consoles', 'clientes'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'console_id' => 'required|exists:consoles,id',
            'cliente_id' => 'required|exists:clientes,id',
            'data_hora_inicio' => 'required|date',
            'data_hora_fim' => 'nullable|date|after:data_hora_inicio',
            'valor_total' => 'required|numeric',
        ]);

        $aluguel = Aluguel::findOrFail($id);
        $aluguel->update($request->all());

        return redirect()->route('alugueis.index')->with('success', 'Aluguel atualizado com sucesso!');
    }

    public function destroy(Aluguel $aluguel)
    {
        $aluguel->delete();
        return redirect()->route('alugueis.index')->with('success', 'Aluguel deletado com sucesso.');
    }
}
