<?php

namespace App\Http\Controllers;

use App\Models\Aluguel;
use App\Models\Cliente;
use App\Models\Console;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalClientes = Cliente::count();
        $totalConsoles = Console::count();

        $alugueisEmAndamento = Aluguel::where('data_hora_inicio', '<=', Carbon::now())
            ->where('data_hora_fim', '>=', Carbon::now())
            ->count();

        $alugueisConcluidos = Aluguel::where('data_hora_fim', '<', Carbon::now())->count();

        $proximosAlugueis = Aluguel::with('cliente', 'console')
            ->where('data_hora_fim', '>', Carbon::now())
            ->orderBy('data_hora_inicio')
            ->take(5)
            ->get();

        $meses = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril',
            'Maio', 'Junho', 'Julho', 'Agosto',
            'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];

        $alugueisPorMes = Aluguel::selectRaw('MONTH(data_hora_inicio) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')->all();

        return view('home', compact(
            'totalClientes',
            'totalConsoles',
            'alugueisEmAndamento',
            'alugueisConcluidos',
            'proximosAlugueis',
            'meses',
            'alugueisPorMes'
        ));
    }
}
