<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutGuestFormRequest;

class CheckoutGuestController extends Controller
{
    public function show(CheckoutGuestFormRequest $request, Book $book)
    {
        $user = User::firstOrCreate([
            'email' => $request->input('email'),
        ], [
            'name' => $request->input('name'),
            'password' => Str::random(10),
            'date_of_birth' => today(),
        ]);

        $order = $user->orders()->create([
            'book_id' => $book->id,
            'price' => $book->final_price,
        ]);

        $paymentIntent = $user->createSetupIntent();

        return view('checkout.guest', compact('paymentIntent', 'book', 'order', 'user'));
    }

    public function store(Request $request)
    {
        $order = Order::with('user')->find($request->input('order_id'));
        $paymentMethod = $request->input('payment_method');

        try {
            $order->user->createOrGetStripeCustomer();
            $order->user->updateDefaultPaymentMethod($paymentMethod);
            $order->user->charge($order->price, $paymentMethod);
        } catch (\Exception $ex) {
            info($ex->getMessage());
        }

        return redirect()->route('success');
    }
}
