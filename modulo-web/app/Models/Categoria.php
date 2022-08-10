<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Criamos o relacionamento entre Categoria e Posts
     * Uma categoria pode ter varios Posts
     * Mas um post pode ter apenas uma categoria
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
