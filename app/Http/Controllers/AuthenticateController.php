<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthenticateController extends Controller
{
    /**
     * Login view
     * @param LoginRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function login(LoginRequest $request): Factory|View|Application|RedirectResponse
    {
        if ($request->isMethod('get')) return view('pages.auth.login');
        $credentials = $request->only(['email', 'password']);
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Logout
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
