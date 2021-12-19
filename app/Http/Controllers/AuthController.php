<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me()
    {
        $re['user'] = auth()->user();
        return response()->json($re);
    }
}
