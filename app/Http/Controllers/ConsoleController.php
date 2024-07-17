<?php

namespace App\Http\Controllers;

use App\Models\Console;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
    public function index()
    {
        $consoles = Console::paginate(10);
        return view('consoles.index', compact('consoles'));
    }

    public function create()
    {
        return view('consoles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'plataforma' => 'required|string|max:255',
            'preco_por_hora' => 'required|numeric',
            'disponibilidade' => 'required|integer',
        ]);

        Console::create($request->all());

        return redirect()->route('consoles.index')->with('success', 'Console criado com sucesso.');
    }

    public function show(Console $console)
    {
        return view('consoles.show', compact('console'));
    }

    public function edit(Console $console)
    {
        return view('consoles.edit', compact('console'));
    }

    public function update(Request $request, Console $console)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'plataforma' => 'required|string|max:255',
            'preco_por_hora' => 'required|numeric',
            'disponibilidade' => 'required|integer',
        ]);

        $console->update($request->all());

        return redirect()->route('consoles.index')->with('success', 'Console atualizado com sucesso.');
    }

    public function destroy(Console $console)
    {
        $console->delete();

        return redirect()->route('consoles.index')->with('success', 'Console deletado com sucesso.');
    }
}