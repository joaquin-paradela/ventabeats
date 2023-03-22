@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tienda</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Productos</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($products as $pro)
                        <div class="col-lg-3">
                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="/images/{{ $pro->image_path }}"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt="{{ $pro->image_path }}"
                                >
                                <div class="card-body">
                                    <a href=""><h6 class="card-title">{{ $pro->name }}</h6></a>
                                    <p>${{ $pro->price }}</p>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $pro->image_path }}" id="img" name="img">
                                        

                                        <div class="embed-responsive embed-responsive-10by9">
                                        <audio controls style="background-color: #f7f7f7"  >
                                        <input type="hidden" value="{{ $pro->audio_path }}" id="audio" name="audio">
                                        <source src="/audio/{{ $pro->audio_path }}" type="audio/mp3"  >
                                            Your browser does not support the audio element.
                                        </audio> 
                                        </div>
                                        <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;">
                                              <div class="row">
                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> agregar al carrito
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  
@endsection

<script>

let currentAudio; // Variable para mantener la referencia al audio actual

window.addEventListener('load', event => {
    // Obtener todos los elementos de audio
    const audios = document.querySelectorAll('audio');

    // Agregar un controlador de eventos a cada elemento de audio
    audios.forEach(audio => {
        // Agregar el controlador de eventos play
        audio.addEventListener('play', event => {
            // Detener el audio actual si existe
            if (currentAudio && currentAudio !== audio) {
                currentAudio.pause();
            }
            // Establecer el audio actual al nuevo audio
            currentAudio = audio;
        });
    });
});


</script>










