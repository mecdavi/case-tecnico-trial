<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function teste(Request $request )
    {
        try {
            dd('aqui');
        }catch ( InvalidCredentialsException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], 401);
        }

    }
}
