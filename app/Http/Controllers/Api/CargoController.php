<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller {

    public function create(Request $request) {
        try {
            $data = $request->only('nombre', 'descripcion', 'sueldoBase', 'idArea');

            $result = DB::select('exec SetCargo ?, ?, ?, ?', [
                $data['nombre'],
                $data['descripcion'],
                $data['sueldoBase'],
                $data['idArea'],
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
            $data = $request->only('nombre', 'descripcion', 'sueldoBase', 'idArea');

            $result = DB::select('exec UpdCargo ?, ?, ?, ?, ?', [
                $id,
                $data['nombre'],
                $data['descripcion'],
                $data['sueldoBase'],
                $data['idArea'],
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

            $result = DB::select('exec DelCargo ?', [
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
            $result = DB::select('exec GetListCargo', []);

            if(!empty($result)) {
                return response()->json(['ok' => true, 'data' => $result], 200);
            }
            return response()->json(['ok' => true, 'data' => []], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

//    public function get(Request $request, $id) {
//        try {
//            $result = DB::select('exec GetRol ?', [
//                $id
//            ]);
//
//            if(!empty($result)) {
//                return response()->json(['ok' => true, 'data' => $result], 200);
//            }
//            return response()->json(['ok' => true, 'data' => []], 200);
//
//        } catch (\Exception $e) {
//            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
//        }
//    }
}
