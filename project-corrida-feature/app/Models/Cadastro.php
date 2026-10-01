<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'telefone',
        'dataNascimento',
        'categoria',
        'percurso',
        'sexo',
        'modalidade',
        'kit',
        'tamanho',
        'pagamento',
        'aceite',
        'status',
        'valor_inscricao',
        'valor_pago',
        'pagamento_divergente',
        'pagbank_reference',
        'pagbank_id',
        'pago_em',
    ];

    protected $casts = [
        'aceite' => 'boolean',
        'pagamento_divergente' => 'boolean',
        'valor_inscricao' => 'decimal:2',
        'valor_pago' => 'decimal:2',
        'pago_em' => 'datetime',
    ];
}
