<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\RegisterPaymentJob;
use App\Models\Payment;
use App\Response\Success;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $request;
    protected $payment;

    public function __construct(Request $request, Payment $payment)
    {
        $this->request = $request;
        $this->payment = $payment;
    }
    public function store()
    {
        $payment = $this->payment->create($this->request->all());
        $this->dispatch(new RegisterPaymentJob($payment));
        return Success::generic($payment,messageSuccess('20000','Pagamento'),'api');
    }
    public function index()
    {
        $payment = $this->payment->all();
        return Success::generic($payment,messageSuccess('20003','Pagamentos'),'api');
    }
    public function findByIdOrInvoice($idOrInvoice)
    {

        $payment = $this->payment->where('id','=',$idOrInvoice)
            ->orWhere('invoice','=',$idOrInvoice)->get();
        return Success::generic($payment,messageSuccess('20003','Pagamento'),'api');
    }
}
