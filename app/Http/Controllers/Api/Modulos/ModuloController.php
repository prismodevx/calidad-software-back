<?php

namespace App\Http\Controllers\Api\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ModuloController extends Controller {
    public function listModulos(Request $request) {
        try {
            $result = DB::select('select * from modulo', []);

            if(!empty($result)) {
                return response()->json(['ok' => true, 'data' => $result], 200);
            }
            return response()->json(['ok' => true, 'data' => []], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }
}
