<?php

namespace App\Http\Controllers;

use App\Models\OperationType;
use Illuminate\Http\Request;

class OperationTypesController extends Controller
{
    public function getOperationTypes() {
        $operation_types = OperationType::all();

        return response()->json([
            'data' => $operation_types
        ]);
    }
}
