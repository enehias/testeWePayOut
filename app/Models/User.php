<?php

namespace App\Models;


use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'document',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Start validations ===============================================================================================
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(new \ShieldForce\AutoValidation\Observers\InterceptObserversModel());
        self::observe(new UserObserver());
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
                                "name"                  => ["required", 'string','min:4'],
                                "password"              => ["required", 'string', 'min:4'],
                                "document"              => ["required", 'string', 'min:11', 'unique:users'],
                                "email"                 => ["required", 'email', 'unique:users'],
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
                                "name"                  => ["required", 'string'],
                                "password"              => ["required", 'string', 'min:4'],
                            ],
                        "messages" =>
                            [
                                //
                            ]
                    ],
            ];
    }
    /**
     * End validations =================================================================================================
     */


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
