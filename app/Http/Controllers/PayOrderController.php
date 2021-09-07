<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Order\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(OrderDetails $orderDetails,PaymentGateway $payment){
        //$payment = new PaymentGateway('usd');
        $order = $orderDetails->all();
        dd($payment->charge(5000));
    }
}
