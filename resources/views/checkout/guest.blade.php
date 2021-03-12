<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('checkout.guest.store', $book) }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="payment_method" id="payment-method" value="" />
                    <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}" />
                    <div id="card-element"></div>

                    <x-button type="button" class="mt-4" id="payment-button">
                        Pay
                    </x-button>

                    <div class="alert alert-danger mt-4 d-none" id="card-error"></div>
                </div>
            </div>
        </div>
    </section>

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.publishable_key') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card', {
            style: {
                base: {
                    iconColor: '#AAA',
                    color: '#333',
                    fontWeight: '500',
                    fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                    fontSize: '16px',
                    fontSmoothing: 'antialiased',
                    ':-webkit-autofill': {
                        color: '#AAA',
                    },
                    '::placeholder': {
                        color: '#AAA',
                    },
                },
                invalid: {
                    iconColor: '#FFC7EE',
                    color: '#FFC7EE',
                },
            },
        })

        cardElement.mount('#card-element');

        $('#payment-button').on('click', function() {
            $('#payment-button').attr('disabled', true);
            stripe
                .confirmCardSetup('{{ $paymentIntent->client_secret }}', {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: "{{ $user->name }}",
                        },
                    },
                })
                .then(function(result) {
                    if (result.error) {
                        $('#card-error').text(result.error.message).removeClass('d-none');
                        $('#payment-button').attr('disabled', false);
                    } else {
                        $('#payment-method').val(result.setupIntent.payment_method);
                        $('#payment-form').submit();
                    }
                });
        })
    </script>
    @endsection
</x-app-layout>
