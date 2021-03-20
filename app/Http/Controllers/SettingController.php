<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SettingController extends Controller
{
    public function show(?string $access_token = null): Factory|View|Application
    {
        return view('pages.dashboard.setting.setting', compact('access_token'));
    }
}
