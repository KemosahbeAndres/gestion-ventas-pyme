<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultUserController extends Controller
{
    public function consult(Request $request) {
        return $request->user();
    }
}
