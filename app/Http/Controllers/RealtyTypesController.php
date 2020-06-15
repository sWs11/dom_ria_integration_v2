<?php

namespace App\Http\Controllers;

use App\Models\RealtyType;
use Illuminate\Http\Request;

class RealtyTypesController extends Controller
{
    public function getRealtyTypes() {
        $realty_types = RealtyType::all();

        return response()->json([
            'data' => $realty_types
        ]);
    }
}
