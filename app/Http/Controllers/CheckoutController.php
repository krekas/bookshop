<?php

namespace App\Http\Controllers;

use App\Models\Book;use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Book $book)
    {
        $checkout = auth()->user()->checkoutCharge($book->final_price, $book->name, 1, [
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $book->final_price,
                    'product_data' => [
                        'name' => $book->name,
                        'images' => [$book->cover->getUrl('cover')],
                    ],
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('user.orders.index'),
            'cancel_url' => route('checkout', $book)
        ]);

        auth()->user()->orders()->create([
            'book_id' => $book->id,
            'price' => $book->final_price
        ]);

        return view('checkout.user', compact('book', 'checkout'));
    }
}
