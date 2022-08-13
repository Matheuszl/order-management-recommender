<?php

namespace App\Models;

use App\Models\Mercado;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $filllable = ['mercado_id', 'descricao', 'tipo', ''];

    /**
     * Os Pedidos tem apenas um mercado
     * e 
     * Um mercado pode estar em varios pedidos
     */
    public function mercado()
    {
        return $this->belongsTo(Mercado::class);
    }


    /**
     * Um Produto pode estar presente em varios Pedidos
     * E
     * Um Pedido pode conter varios Produtos
     * N*N
     */
    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }
}
