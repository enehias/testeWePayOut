<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentObserver
{
    protected $request;
    public $afterCommit = true;

    public function __construct(Request $request=null)
    {
        $this->request = $request;
    }

    public function created(Payment $payment)
    {
        ;
        $idClient = uniqid(auth()->id().'|',true);
        $payment->update(['invoice'=>"$payment->id|$idClient"]);

    }

}
