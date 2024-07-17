<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'plataforma', 'preco_por_hora', 'disponibilidade'];

    // Relacionamento com Aluguel
    public function alugueis()
    {
        return $this->hasMany(Aluguel::class);
    }
}