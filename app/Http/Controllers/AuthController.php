<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me()
    {
        $re['user'] = auth()->user();
        return response()->json($re);
    }

    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json(['access_token' => $token]);
    }

    public function token()
    {
        $payload = auth()->getPayload();
        return response()->json([
            'expired_at'    => Carbon::createFromTimestamp($payload->get('exp'))->toIso8601ZuluString(),
            'not_before_at' => Carbon::createFromTimestamp($payload->get('nbf'))->toIso8601ZuluString(),
            'issued_at'     => Carbon::createFromTimestamp($payload->get('iat'))->toIso8601ZuluString(),
        ]);

    }
}
