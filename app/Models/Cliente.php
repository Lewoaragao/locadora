<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];

    // Relacionamento com Aluguel
    public function alugueis()
    {
        return $this->hasMany(Aluguel::class);
    }
}