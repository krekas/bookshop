<?php

namespace App\Http\Controllers;

use App\Models\Book;use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function show(Request $request, Book $book)
    {
        $checkout = $request->user()->checkoutCharge($book->final_price, $book->name, 1, [
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
            'cancel_url' => route('buy.show', $book)
        ]);

        return view('buy.show', compact('book', 'checkout'));
    }
}
