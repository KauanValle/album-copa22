<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FigurinhaController extends Controller
{
    public function index() {
        return response()->json(['data' => 'olá mundo!']);
    }
}
