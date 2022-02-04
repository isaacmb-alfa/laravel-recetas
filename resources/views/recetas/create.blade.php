@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"
        integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
    <a class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold d-inline-flex align-items-center"
        href="{{ route('recetas.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye mr-1"
            viewBox="0 0 16 16">
            <path
                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
        </svg>
        Ver Recetas</a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Crear Nueva Receta</h2>
    <div class="row justify-content-center mt-5">
        <div class="col md-8">
            <form action="{{ route('recetas.store') }}" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="titulo">Título Receta</label>
                    <input type="text" value="{{ old('titulo') }}" name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror" id="titulo" placeholder="Título Receta" />

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">

                        <option value="">--Seleccione--</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="ingredientes">Ingredientes</label>
                    <input type="hidden" id="ingredientes" name="ingredientes" value="{{ old('ingredientes') }}">
                    <trix-editor class="form-control @error('ingredientes') is-invalid @enderror" input="ingredientes">
                    </trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="preparacion">Preparación</label>
                    <input type="hidden" id="preparacion" name="preparacion" value="{{ old('preparacion') }}">
                    <trix-editor class="form-control @error('preparacion') is-invalid @enderror" input="preparacion">
                    </trix-editor>
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="imagen">Elige la imagen</label>
                    <input for="imagen" type="file" name="imagen"
                        class="form-control @error('imagen') is-invalid @enderror">
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" value="Agregar Receta" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
        integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
