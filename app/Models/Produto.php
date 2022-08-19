<?php

namespace App\Models;

use App\Models\Pedido;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['nome', 'preco', 'ativo', 'slug'];


    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class);
    }

}
