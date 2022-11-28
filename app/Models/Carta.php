<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;
    protected $appends = ['categorias'];

    public function getCategoriasAttribute()
    {
        return $this->categorias();
    }
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }
}
