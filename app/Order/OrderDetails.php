<?php

namespace App\Order;

use App\Billing\PaymentGateway;

class OrderDetails{

    private $paymentGateway;
    public function  __construct(PaymentGateway $paymentGateway){
        $this->paymentGateway = $paymentGateway;
    }

    public function all(){
        //discount set
        $this->paymentGateway->setDiscount(500);
        return [
            'name' => 'sakib',
            'address' => 'test content'
        ];
    }
}
