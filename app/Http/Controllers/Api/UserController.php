<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Response\Error;
use App\Response\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var User
     */
    protected $user;

    /**
     * UserController constructor.
     * @param Request $request
     * @param User $user
     */
    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }
    public function index()
    {
        $users = $this->user->all();
        return Success::generic($users,messageSuccess('20003','Usuários'),'api');

    }


    public function store()
    {
        dd('teste');
        $validation = Validator::make($this->request->all(),
            [
                // Rules
                'password'      => ["required", "string","min:2","regex:/^[0-9]+$/"],
            ],
            [
                // Messages -----------------------------------------------------------
            ]
        );

        // Retirnando erros de validações de campos se caso houver
        if($validation->fails())
        {
            return Error::generic(
                $validation->errors(),
                messageErrors(4003, "Atenção aos erros de validação!"),
                $this->request["routeType"]
            );
        }
        dd('teste');
        $user = $this->user->create($this->request->all());
        return Success::generic($user,messageSuccess('20000','Usuário'),'api');
    }

    public function delete($id)
    {
        $user = $this->user->find($id);
        if($user){
            $user->delete();
            return Success::generic($user,messageSuccess('20002','Usuário'),
                'api');
        }
        return Error::generic(null,messageErrors('1002','Usuário'),
            'api');
    }
}
