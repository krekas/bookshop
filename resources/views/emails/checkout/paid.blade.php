@component('mail::message')
# Hi, {{ $user->name }}

Your order is paid.

@component('mail::table')
| ![{{ $order->book->name }}]({{ asset($order->book->cover->getUrl('cover')) }})       | {{ $order->book->name }}         | {{ $order->price }}  |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
