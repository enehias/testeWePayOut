<?php

namespace App\Models;

use App\Observers\PaymentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use ShieldForce\AutoValidation\Observers\InterceptObserversModel;
use ShieldForce\AutoValidation\Traits\TraitStartInterception;


class Payment extends Model
{
    use HasFactory;
    use TraitStartInterception;
    protected $fillable = [
        'invoice','beneficiary_name','code_bank',
        'number_agency','number_account','value_payment'
        ,'status','bank_processor'
        ];

    /**
     * Start validations ===============================================================================================
     */
    protected static function  boot()
    {
        parent::boot();
        self::observe(new InterceptObserversModel());
        self::observe(new PaymentObserver());
    }
    public static function rulesCustom(Request $request)
    {

        return
            [
                "request"                      => $request,
                "creating"                     =>
                    [
                        "validations"  =>
                            [
                                'invoice'                 => ['unique:payments'],
                                'beneficiary_name'        => ['string'],
                                'value_payment'           => ['required','numeric', 'max:100000', 'min:0.01'],
                                'code_bank'               => ['required', 'string', 'max:3',"regex:/^[0-9]+$/",],
                                'number_agency'           => ['required', 'string', 'max:4',"regex:/^[0-9]+$/",],
                                'number_account'          => ['required', 'string', 'max:15',"regex:/^[0-9]+$/",],
                            ],
                        "messages" =>
                            [
                                //
                            ]
                    ],
                "updating"                     =>
                    [
                        "validations"  =>
                            [
                                'invoice'                 => ['unique:payments'],
                                'beneficiary_name'        => ['string'],
                                'value_payment'           => ['numeric', 'max:100000', 'min:0.01'],
                                'code_bank'               => ["regex:/^[0-9]+$/", 'string', 'max:3'],
                                'number_agency'           => ['required', 'string', 'max:4',
                                                                'regex:/^[0-9]+$/'],
                                'number_account'          => ['required', 'string', 'max:15',
                                                                'regex:/^[0-9]+$/'],
                            ],
                        "messages" =>
                            [
                                //
                            ]
                    ],
            ];
    }
    /**
     * End validations ===============================================================================================
     */
}
