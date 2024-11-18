<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolController extends Controller {

    public function create(Request $request) {
        try {
            $data = $request->only('nombre', 'detalle');

            $result = DB::select('exec SetRol ?, ?', [
                $data['nombre'],
                $data['detalle'],
            ]);

            if(empty($result)) {
                return response()->json(['error' => 'Error'], 401);
            }

            if($result[0]->ok == 1) {
                return response()->json(['ok' => true, 'message' => $result[0]->message], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $data = $request->only('nombre', 'detalle');

            $result = DB::select('exec UpdRol ?, ?, ?', [
                $id,
                $data['nombre'],
                $data['detalle'],
            ]);

            if(empty($result)) {
                return response()->json(['error' => 'Error'], 401);
            }

            if($result[0]->ok == 1) {
                return response()->json(['ok' => true, 'message' => $result[0]->message], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function delete(Request $request, $id) {
        try {
            $result = DB::select('exec DelRol ?', [
                $id
            ]);

            if(empty($result)) {
                return response()->json(['error' => 'Error'], 401);
            }

            if($result[0]->ok == 1) {
                return response()->json(['ok' => true, 'message' => $result[0]->message], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function list(Request $request) {
        try {
            $result = DB::select('select * from rol where activo = 1', []);

            if(!empty($result)) {
                return response()->json(['ok' => true, 'data' => $result], 200);
            }
            return response()->json(['ok' => true, 'data' => []], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }
}
