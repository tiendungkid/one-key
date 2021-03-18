<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportServiceRequest;
use App\Services\AppServices\AppService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function __construct(
        protected AppService $appService
    )
    {
    }

    public function show(): Factory|View|Application
    {
        $services = $this->appService->appServiceRepository->allWithCountAccountCount();
        return view('pages.dashboard.service.service', compact('services'));
    }

    public function import(ImportServiceRequest $request): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('GET')) return view('pages.dashboard.service.import');
        $file = $request->file('file');
        $this->appService->importFromJsonFile($file->getRealPath());
        return redirect()->route('services');
    }

    public function export()
    {

    }
}
