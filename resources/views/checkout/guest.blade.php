<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex justify-center">
                        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                            <div class="px-4 py-2">
                                <h1 class="text-3xl font-bold text-gray-800 uppercase tracking-wide">{{ $book->name }}</h1>
                            </div>

                            <img class="object-cover object-center w-full h-56 mt-2" src="{{ asset($book->cover->getUrl('cover')) }}" alt="{{ $book->name }}">

                            <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                                <h1 class="text-lg font-bold text-white">@money($book->final_price)</h1>
                            </div>
                        </div>
                    </div>

                        <div>
                        <div class="mb-2"><span class="font-semibold">Name:</span> {{ $user->name }}</div>
                        <div class="mb-4"><span class="font-semibold">Email:</span> {{ $user->email }}</div>

                        <form action="{{ route('checkout.guest.store', $book) }}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" name="payment_method" id="payment-method" value="" />
                            <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}" />
                            <div id="card-element"></div>

                            <x-button type="button" class="mt-4" id="payment-button">
                                Pay
                            </x-button>

                            <div class="alert alert-danger mt-4 d-none" id="card-error"></div>
                        </form>

                        <div class="text-sm text-gray-400 mt-4">All transaction are made using stripe.</div>
                        </div>
                    </div>
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
