<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Modulos\ModuloController;
use App\Http\Controllers\Api\RolController;
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


    # roles
    Route::get('/roles', [RolController::class, 'list']);
    Route::post('/roles', [RolController::class, 'create']);
    Route::put('/roles/{id}', [RolController::class, 'update']);
    Route::delete('/roles/{id}', [RolController::class, 'delete']);
});

