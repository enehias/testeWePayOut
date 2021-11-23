<?php
namespace App\Factory;

use App\Models\Payment;
use App\Strategy\BankOne;
use App\Strategy\BankTwo;
use App\Strategy\IBank;
use Illuminate\Http\Request;

abstract class BankFactory
{

    public static function create(Payment $payment) : IBank
    {
        return (($payment->id%2) ==0) ? new BankTwo($payment) : new BankOne($payment);
    }
}
