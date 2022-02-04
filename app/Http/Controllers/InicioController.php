<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        //* mostrar las recetas por cantidad de votos
        // $votadas = Receta::has('likes', '>', 0)->get();
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'DESC')->take(3)->get();

        // return $votadas;
        //obtener las recetas mas nuevas
        $nuevas = Receta::latest()->take(6)->get();

        //Obtener las categorias
        $categorias = CategoriaReceta::all();

        // Agrupar las recetas por categoria
        $recetas = [];

        foreach($categorias as $categoria)
        {
            $recetas[Str::slug( $categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }
            // return $recetas;
 
        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
