<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Aluguel extends Model
{
    use HasFactory;

    protected $fillable = ['console_id', 'cliente_id', 'data_hora_inicio', 'data_hora_fim', 'valor_total'];

    // Relacionamento com Console
    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    // Relacionamento com Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Acessor para formatar data_hora_inicio
    public function getDataHoraInicioAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }

    // Acessor para formatar data_hora_fim
    public function getDataHoraFimAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i') : null;
    }
}
