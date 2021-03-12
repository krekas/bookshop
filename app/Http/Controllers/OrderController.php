<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('book')->latest()->paginate();

        return view('front.user.orders.index', compact('orders'));
    }
}
