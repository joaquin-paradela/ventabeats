<x-app-layout>
    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Tienda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(count($errors) > 0)
            @foreach($errors0>all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if(\Cart::getTotalQuantity()>0)
                    <h4>{{ \Cart::getTotalQuantity()}} Producto(s) en el carrito</h4><br>
                @else
                    <h4>No Product(s) In Your Cart</h4><br>
                    <a href="/" class="btn btn-dark">Continue en la tienda</a>
                @endif

                @foreach($cartCollection as $item)
                   
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/images/{{ $item->attributes->image }}" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5">
                            <p>
                                <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                                <b>Price: </b>${{ $item->price }} <br>
                               <!---  <b>Sub Total: </b>${{ \Cart::get($item->id)->getPriceSum() }}<br> -->
                                <b>Audio: </b>
                                    <audio controls >
                                    <input type="hidden" value="{{ $item->audio_path }}" id="audio" name="audio">
                                    <source src="/audio/{{ $item->attributes->audio }}" type="audio/mp3" >
                                            Your browser does not support the audio element.
                                    </audio> <br>
                                {{--                                <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($cartCollection)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Borrar Carrito</button> 
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b>${{ \Cart::getTotal() }}</li>
                        </ul>
                    </div>
                    <br><a href="/shop" class="btn btn-dark">Continue en la tienda</a>
                    <form action="{{route('checkout')}}" method="POST">
                     @csrf
                     <button class="btn btn-success">Checkout</button>
                    </form>
                </div>
            @endif
        </div>
        <br><br>
    </div>
    </x-app-layout>


<script>

   document.addEventListener('DOMContentLoaded', event => {

    setupAudioPlayers();

    });

    function setupAudioPlayers() {
        let currentAudio; // Variable para mantener la referencia al audio actual
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
        }
        
</script>

