<?php
namespace App\Strategy;
use App\Models\Payment;

interface IBank
{
    public function __construct(Payment $payment);

    public function registerPayment();
    public function searchPayment();
}
