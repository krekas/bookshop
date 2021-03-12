<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierWebhookController;

class WebhookController extends CashierWebhookController
{
    public function handleCheckoutSessionCompleted($payload)
    {        
        if ($user = $this->getUserByStripeId($payload['data']['object']['customer'])) {
            Log::info($user);
            //$oder = $user->orders()->create();
            //$order->books()->attach($cart->products);
        }
    }
}
