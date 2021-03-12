@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="mb-4 text-center">
            <h2>Confirm order and pay</h2>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card p-2">
                    <div class="my-3">
                        <h5 class="text-uppercase text-center">Shipping Address</h5>
                        <div class="mb-2">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" value="{{ $address->country }}" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control" value="{{ $address->state }}" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" class="form-control" value="{{ $address->zipcode }}" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="city">City</label>
                            <input type="text" class="form-control" value="{{ $address->city }}" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" value="{{ $address->address }}" disabled>
                        </div>
                        <div class="mb-2">
                            <label for="address">Full Name</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->fullName() }}" disabled>
                        </div>
                        <a href="{{ route('address.edit', $address->id) }}" >Edit</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card p-3">
                    <div class="my-3">
                        @include('partials.messages')
                        <div id="card-error" class="text-danger"></div>
                        <form action="{{ route('checkout.purchase') }}" method="POST" id="payment-form">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="">Name on the card</label>
                                <input id="card-holder-name" type="text" class="form-control" required>
                            </div>

                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element" class="my-3"></div>

                            <!-- Payment Intent Method -->
                            <input type="hidden" name="payment_method" id="payment-method">

                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-success">
                                            Proceed Payment
                                    </button>
                                </div>

                                <div>
                                    <span>Total to pay</span>
                                    <h2>${{ $cart['total'] }}</h2>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');

    const elements = stripe.elements();
    const style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '22px',
            '::placeholder': {
                color: '#32325d'
            }
        },
        invalid: {
            color: '#ff2a00',
            iconColor: '#fd2a00'
        }
    }
    const cardElement = elements.create('card', {style: style})
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        document.getElementById('card-button').disabled = true;

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            },
        ).then(function(result) {
            if (result.error) {
                $('#card-error').text(result.error.message).removeClass('d-none');
                document.getElementById('card-button').disabled = false;
            } else {
                $('#payment-method').val(result.setupIntent.payment_method);
                $('#payment-form').submit();
            }
        });
    });
</script>
@endsection
