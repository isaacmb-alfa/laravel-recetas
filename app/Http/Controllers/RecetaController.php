<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Receta $receta)
    {
        $usuario = auth()->user();
 
        //Receta con paginación
        $recetas = Receta::where('user_id', $usuario->id)->paginate(3);
        

        // auth()->user()->recetas->dd();
        // $usuario = auth()->user();
        // $recetas = auth()->user()->recetas;
        return view('recetas.index', compact('recetas', 'usuario', 'receta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();

        //** obtener las categorias (sin modelo) */
        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
        //** obtener categorias con modelo */
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('imagen')->store('upload-recetas', 'public'));
        //Validación  
        $data = request()->validate([
            'titulo' => ['required', 'min:5'],
            'categoria' => ['required'],
            'ingredientes' => ['required'],
            'preparacion' => ['required'],
            'imagen' => ['required', 'mimes:jpg,jpeg,png,gif'],

        ]);
        // Obtener la ruta de la imagen
        $ruta_imagen = $request->file('imagen')->store('upload-recetas', 'public');
        // Usando Intervention/image
        $img = Image::make(public_path("storage/$ruta_imagen"));
        $img->fit(1000, 550);
        $img->save();

        //Almacenar los datos en la bace de datos (sin Modelo)
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'ingredientes' => $data['ingredientes'],
        //     'preparacion' => $data['preparacion'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria'],
        // ]);

        //Almacenar en la base de datos (con modelo)
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);
        //Redireccionar
        return redirect()->route('recetas.index', compact('receta'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Obtener si el usuario actual le gusa la receta y esta autenticado

        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        //Pasa la cantidad de likes a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //** Revisar el policy */
        $this->authorize('update', $receta);

        //** Validando la receta  */
        $data = request()->validate([
            'titulo' => ['required', 'min:5'],
            'categoria' => ['required'],
            'ingredientes' => ['required'],
            'preparacion' => ['required'],

        ]);
         //*** Asignar valores */
         $receta->titulo = $data['titulo'];
         $receta->categoria_id = $data['categoria'];
         $receta->ingredientes = $data['ingredientes'];
         $receta->preparacion = $data['preparacion'];

            //***Si el usuario sube una nueva imagen */
        if(request('imagen'))
        {
        // Obtener la ruta de la imagen
        $ruta_imagen = $request->file('imagen')->store('upload-recetas', 'public');
        
        if($receta->imagen != '')
        {
            unlink(storage_path('app/public/'. $receta->imagen));
        }
        // return $receta;

        // Usando Intervention/image
        $img = Image::make(public_path("storage/$ruta_imagen"));
        $img->fit(1000, 550);
        $img->save();
        $receta->imagen = $ruta_imagen;
        }
        // Storage::disk('public')->delete($receta->imagen);

        $receta->save();

        return redirect()->route('recetas.show', ['receta' => $receta->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //** Revisar el policy */
        $this->authorize('delete', $receta);

        Storage::disk('public')->delete($receta->imagen);

        $receta->delete();

        return redirect()->route('recetas.index');
    }

    public function search(Request $request) 
    {
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        $recetas= Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(6);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
