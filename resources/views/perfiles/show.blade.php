@extends('layouts.app')
@section('botones')
    <a class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold d-inline-flex align-items-center"
        href="{{ route('recetas.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-file-earmark-plus mr-1" viewBox="0 0 16 16">
            <path
                d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
            <path
                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
        </svg>
        Crear Receta</a>
    @auth
        <a class="btn btn-outline-success mr-2 text-uppercase font-weight-bold d-inline-flex align-items-center"
            href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id]) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-lines-fill mr-1" viewBox="0 0 16 16">
                <path
                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
            </svg>Editar perfil</a>
    @endauth

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if ($perfil->imagen)
                    <img src="/storage/{{ $perfil->imagen }}" class="w-100 rounded-circle" alt="imagen chef">
                @else
                    <h2 class="text-info">No tienes imagen para mostrar</h2>
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2 text-primary ">{{ $perfil->usuario->name }}</h2>
                <a href="{{ $perfil->usuario->url }}"><span>{{ $perfil->usuario->url }}</span><strong> Visitar Sitio
                        Web</strong> </a>
                <div class="biografia">
                    {!! $perfil->biografia !!}
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Recetas Creadas por: {{ $perfil->usuario->name }}</h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if (count($recetas) > 0)
                @foreach ($recetas as $receta)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{ $receta->imagen }}" alt="{{ $receta->title }}" class="card-img-top">
                            <div class="card-body">
                                <h3 class="card-title">{{ $receta->titulo }}</h3>
                                <a class="btn btn-outline-primary d-block mt-4 text-uppercase font-weight-bold"
                                    href="{{ route('recetas.show', ['receta' => $receta->id]) }}">Ver Receta</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center w-100">no hay recetas para mostrar</p>
            @endif

        </div>
        
        <div class="d-flex justify-content-center mt-5">
            {{ $recetas->links() }}
        </div>
    </div>

@endsection
