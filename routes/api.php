<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login/', [AuthController::class, 'login'])->name('login');

Route::middleware(["apiJWT"])->group(function () {

    Route::post('logout/', [AuthController::class, 'logout'])->name('logout');


    // Grupo de Rotas do Controller "Users"
    Route::prefix('user/')->name('user.')->group(function () {

        Route::post('', [UserController::class, "store"])
            ->name('store')
            ->setWheres([
                "label" => "Ação de Criação de ",
                "group" => "Usuários",
            ]);

        Route::get('', [UserController::class, "index"])
            ->name('index')
            ->setWheres([
                "label" => "Visualizar ",
                "group" => "Usuários",
            ]);

        Route::delete('/{id?}', [UserController::class, "delete"])
            ->name('delete')
            ->setWheres([
                "label" => "Ação de Exclusão de ",
                "group" => "Usuários",
            ]);
    });

    //Grupo de Rotas do Controller "Payments"
    Route::prefix('payment/')->name('payment.')->group(function () {

        Route::post('', [PaymentController::class, "store"])
            ->name('store')
            ->setWheres([
                "label" => "Ação de Criação de ",
                "group" => "Pagamento",
            ]);
        Route::get('', [PaymentController::class, "index"])
            ->name('index')
            ->setWheres([
                "label" => "Visualizar ",
                "group" => "Pagamento",
            ]);

        Route::get('/{id}', [PaymentController::class, "findByIdOrInvoice"])
            ->name('findByIdOrInvoice')
            ->setWheres([
                "label" => "Buscar ",
                "group" => "Pagamento",
            ]);

    });
});



