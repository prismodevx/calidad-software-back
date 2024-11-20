<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Modulos\ModuloController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\TrabajadorController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/usuario-exists', [AuthController::class, 'existeUsuario']);
Route::get('/modulos', [ModuloController::class, 'listModulos']);

Route::get('/check-db-credentials', function () {
    return [
        'driver' => env('DB_CONNECTION'),
        'host' => env('DB_HOST'),
        'port' => env('DB_PORT'),
        'database' => env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD')
    ];
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('test', [AuthController::class, 'test']);
    Route::post('/logout', [AuthController::class, 'logout']);


    # modulos
    Route::get('/modulos', [ModuloController::class, 'list']);

    # usuarios
    Route::get('/usuarios', [UsuarioController::class, 'list']);
    Route::post('/usuarios', [UsuarioController::class, 'create']);
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'delete']);

    # roles
    Route::get('/roles', [RolController::class, 'list']);
    Route::get('/roles/{id}', [RolController::class, 'get']);
    Route::post('/roles', [RolController::class, 'create']);
    Route::put('/roles/{id}', [RolController::class, 'update']);
    Route::delete('/roles/{id}', [RolController::class, 'delete']);

    # areas
    Route::get('/areas', [AreaController::class, 'list']);
    Route::post('/areas', [AreaController::class, 'create']);
    Route::put('/areas/{id}', [AreaController::class, 'update']);
    Route::delete('/areas/{id}', [AreaController::class, 'delete']);

    # cargos
    Route::get('/cargos', [CargoController::class, 'list']);
    Route::post('/cargos', [CargoController::class, 'create']);
    Route::put('/cargos/{id}', [CargoController::class, 'update']);
    Route::delete('/cargos/{id}', [CargoController::class, 'delete']);

    # trabajadores
    Route::get('/trabajadores', [TrabajadorController::class, 'list']);
    Route::post('/trabajadores', [TrabajadorController::class, 'create']);
    Route::put('/trabajadores/{id}', [TrabajadorController::class, 'update']);
    Route::delete('/trabajadores/{id}', [TrabajadorController::class, 'delete']);
});

