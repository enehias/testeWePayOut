<?php

namespace App\Strategy;

use App\Models\Payment;

class BankOne implements IBank
{
    private  $payment;
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function registerPayment()
    {
        $this->payment->update(['status'=>'PROCESSADO','bank_processor'=>'BANCO 1']);
    }

    public function searchPayment()
    {
        $status = ['PAGO','REJEITADO'];
        shuffle($status);
        $this->payment->update(['status'=>$status[0]]);
        return $this->payment->find($this->payment->id);
    }

}
