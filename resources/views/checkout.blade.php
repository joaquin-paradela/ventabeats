@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkout') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('checkout.process') }}" id="payment-form">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card-element" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card') }}</label>

                            <div class="col-md-6">
                                <div id="card-element" class="form-control">
                                    <!-- Stripe Element Placeholder -->
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Pay') }}
                                </button>
                            </div>
                        </div>

                        <!-- Stripe Token Hidden Input -->
                        <input type="hidden" name="stripeToken" id="stripeToken">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Stripe Initialization
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        // Stripe Elements Creation
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        // Stripe Element Mount
        cardElement.mount('#card-element');

        // Stripe Token Creation on Form Submit
        const paymentForm = document.getElementById('payment-form');
        paymentForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { token, error } = await stripe.createToken(cardElement);

            if (error) {
                console.error(error);
            } else {
                document.getElementById('stripeToken').value = token.id;
                paymentForm.submit();
            }
        });
    </script>
@endsection