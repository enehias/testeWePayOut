<?php

namespace App\Observers;

use App\Models\User;
use App\Response\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserObserver
{
    protected $request;
    public $afterCommit = true;

    public function __construct(Request $request=null)
    {
        $this->request = $request;
    }
    public function creating(User $user){
    }
    public function created(User $user)
    {
       $user->update(['password'=>Hash::make($user->password)]);
    }

}
