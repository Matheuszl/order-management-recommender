<?php

namespace App\Models;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mercado extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'endereco', 'contato', 'porte', 'slug', 'ativo'];

    /**
     * Um mercado pode estar em varios pedidos
     * Mas
     * Um pedido tem apenas um mercado
     */
    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }
}
