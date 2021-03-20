<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function refreshAccessToken(): Application|Factory|View
    {
        /** @var User $user */
        $user = auth()->user();
        $user->tokens()->delete();
        $access_token = $user->createToken('OneKeyAuthenticateChromeExtension')->plainTextToken;
        $access_token = "Bearer {$access_token}";
        return view('pages.dashboard.setting.setting', compact('access_token'));
    }
}
