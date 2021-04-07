<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @return [string] access_token
     * @return [object] user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Неправильные данные входа'
            ], 401);

        $access_token = Auth::user()->createToken('access_token')->accessToken;

        return response()->json([
            'access_token' => $access_token,
            'user' => Auth::user(),
        ]);
    }
}
