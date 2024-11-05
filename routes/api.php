<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Modulos\ModuloController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/usuario-exists', [AuthController::class, 'existeUsuario']);

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
    Route::get('/modulos', [ModuloController::class, 'listModulos']);
});

