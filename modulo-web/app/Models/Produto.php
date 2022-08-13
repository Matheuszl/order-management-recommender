<?php

namespace App\Models;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $filllable = ['nome', 'preco',  'slug', 'ativo', 'slug', 'realizado'];


    public function produtos()
    {
        return $this->belongsToMany(Pedido::class);
    }

}
