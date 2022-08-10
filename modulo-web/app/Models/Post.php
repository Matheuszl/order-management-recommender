<?php

namespace App\Models;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id','name', 'body', 'slug', 'publicado'];

    protected $casts = [
        'publicado' => 'boolean',
    ];

    /**
     * Um post pode ter apenas uma categoria
     */
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
