<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Response\Error;
use App\Response\Success;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function username()
    {
        return 'document';
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm(Request $request)
    {

        $title = "Tela de Acesso!";
        return view("auth.login", compact("title"));
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {

        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        if($request["routeType"]=="web")
        {
            return $request->wantsJson()
                ? new Response('', 204)
                : redirect()->intended($this->redirectPath())
                    ->with("data", $request->all())
                    ->with("success", "Logado com sucesso!")
                ;
        }

        if($request["routeType"]=="api")
        {

            return Success::generic(
                $request->all(),
                messageSuccess(10000),
                $request["routeType"],
                $this->redirectPath()
            );
        }

    }

    public function login(Request $request)
    {

        $this->validateLoginDocumentNumber($request);
        $user = User::where("documento", $request->documento)->get()->first();

        if(!empty($user)){
            $request["documento"] = $user->documento;

        }else{
            return Error::generic(
                null,
                messageErrors(3000),
                $request["routeType"]
            );
        }
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }

    protected function validateLoginDocumentNumber(Request $request)
    {
        $request->validate([
            $this->username()    => ['required', 'string'],
            'password'           => ['required', 'string'],
        ]);
    }
}
