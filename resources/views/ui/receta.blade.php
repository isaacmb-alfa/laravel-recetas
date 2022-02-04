<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{ $receta->imagen }}" alt="imagen-card" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">{{ $receta->titulo }}</h3>
            <div class="meta-receta d-flex justify-content-between">
                @php
                    $fecha = $receta->created_at;
                    
                @endphp
                <p class="text-primay fecha font-weight-bold">
                    <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
                </p>
                <p class="text-primay fecha font-weight-bold">{{ count($receta->likes) }} <span
                        class=" text-black-50">Les Gustó</span> </p>
            </div>
            <p class="card-text">
                {{ Str::words(strip_tags($receta->preparacion), 20, ' ver mas ...') }}</p>
            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}"
                class="btn btn-primary font-weight-bold btn-receta d-block text-uppercase"> Ver
                Receta</a>
        </div>
    </div>
</div>
