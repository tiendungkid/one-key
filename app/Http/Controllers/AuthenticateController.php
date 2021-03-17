<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    /**
     * Login view
     * @param Request $request
     * @return Factory|View|Application
     */
    public function login(Request $request): Factory|View|Application
    {
        if ($request->isMethod('get')) return view('pages.auth.login');
        $userInfo = $request->only(['email', 'password']);

    }
}
