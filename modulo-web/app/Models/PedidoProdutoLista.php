<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProdutoLista extends Model
{
    use HasFactory;

    protected $fillable = ['produto_id', 'pedido_id', 'quantidade'];

    protected $table = 'pedido_produto';
}
