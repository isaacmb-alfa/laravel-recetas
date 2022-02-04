<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    // Campos que se agregan
    protected $fillable = [
        'titulo', 'ingredientes', 'preparacion', 'imagen', 'categoria_id',
    ];
    // Obtiene la categoria de la receta via llave foranea
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }
    //Obtiene la información del usuario via ForanKie
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //likes que ha recibido una receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
