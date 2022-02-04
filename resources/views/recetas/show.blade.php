@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')
    {{-- {{ $receta }} --}}
    <article class="contenido-receta bg-white p-5 shadow redondeado">
        <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>
        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen }}" alt="{{ $receta->titulo }}" class="w-100">
        </div>
        <div class="receta-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary">Escrito en: </span>
                <a class="text-black-50" href="{{ route('categorias.show', ['categoriaReceta' => $receta->categoria->id]) }}">
                {{ $receta->categoria->nombre }}
                </a>
            </p>
            <p>
                <span class="font-weight-bold text-primary">Escrito por: </span>
                 <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $receta->autor->id]) }}">
                {{ $receta->autor->name }}
                 </a>
            </p>
            <p>
                @php
                    $fecha = $receta->created_at;
                @endphp
                <span class="font-weight-bold text-primary">Publicado: </span>
                {{-- Componente --}}
                <fecha-receta fecha="{{ $fecha }}"></fecha-receta> - {{ $receta->created_at->diffForHumans() }}

            </p>

            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                <p>{!! $receta->ingredientes !!}</p>
            </div>
            <div class="prepparacion">
                <h2 class="my-3 text-primary">Preparación</h2>
                <p>{!! $receta->preparacion !!}</p>
            </div>
            <div class="justify-content-center row text-center">
            <like-button receta-id="{{ $receta->id }}" like="{{ $like }}" likes="{{ $likes }}" ></like-button>
            </div>
        </div>
    </article>

@endsection
