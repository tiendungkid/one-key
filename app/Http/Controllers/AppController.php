<?php

namespace App\Http\Controllers;

use App\Repositories\AccountRepository\AccountRepository;
use App\Repositories\AppServiceRepository\AppServiceRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AppController extends Controller
{
    public function __construct(
        protected AccountRepository $accountRepository,
        protected AppServiceRepository $appServiceRepository,
    )
    {
    }

    /**
     * Overview
     * @return Factory|View|Application
     */
    public function dashboard(): Factory|View|Application
    {
        $totalAccount = $this->accountRepository->countAll();
        $totalService = $this->appServiceRepository->countAll();
        return view('pages.dashboard.dashboard', compact('totalAccount', 'totalService'));
    }
}
