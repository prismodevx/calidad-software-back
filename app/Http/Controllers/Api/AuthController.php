<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('usuario', 'password');

        try {
            $result = DB::select('exec VerificarUsuario ?, ?', [
                $credentials['usuario'],
                $credentials['password'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'error en el servidor'], 500);
        }

        if(empty($result)) {
            return response()->json(['error' => 'credenciales incorrectas'], 401);
        }

        $userData = $result[0];

        $user = Usuario::where('usuario', $userData->usuario)->first();

        if(!$user) {
            return response()->json(['error' => 'usuario no encontrado en la bd'], 404);
        }

        try {
            $token = JWTAuth::fromUser($user);
        }catch(\Exception $e) {
            return response()->json(['error' => 'no se pudo crear el token'], 500);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        try {
            // Obtén el token del encabezado de autorización
            $token = JWTAuth::getToken();

            // Invalida el token para realizar el logout
            JWTAuth::invalidate($token);

            return response()->json(['message' => 'Logout exitoso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo cerrar la sesión'], 500);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function test(Request $request)
    {
        $token = 'api-test';

        return response()->json(compact('token'));
    }
}
