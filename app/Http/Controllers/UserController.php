<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function refreshAccessToken(): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->tokens()->delete();
        $access_token = $user->createToken('OneKeyAuthenticateChromeExtension')->plainTextToken;
        $access_token = "Bearer $access_token";
        session(['personal_access_token' => $access_token]);
        return back();
    }
}
