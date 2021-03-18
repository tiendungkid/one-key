<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    public function show(): Factory|View|Application
    {
        return view('pages.dashboard.profile.profile');
    }
}
