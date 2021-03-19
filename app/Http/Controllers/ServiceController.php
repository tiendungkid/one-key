<?php

namespace App\Http\Controllers;

use App\Http\Requests\HasIdRequest;
use App\Http\Requests\ImportServiceRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Services\AppServices\AppService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ServiceController extends Controller
{
    /**
     * ServiceController constructor.
     * @param AppService $appService
     */
    public function __construct(
        protected AppService $appService
    )
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function show(): Factory|View|Application
    {
        $services = $this->appService->appServiceRepository->allWithCountAccountCount();
        return view('pages.dashboard.service.service', compact('services'));
    }

    /**
     * @param ImportServiceRequest $request
     * @return View|Factory|RedirectResponse|Application
     */
    public function import(ImportServiceRequest $request): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('GET')) return view('pages.dashboard.service.import');
        $file = $request->file('file');
        $this->appService->importFromJsonFile($file->getRealPath());
        return redirect()->route('services');
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        $filePath = $this->appService->exportToJsonFile();
        if (!$filePath) abort(500);
        return response()->download($filePath)->deleteFileAfterSend();
    }

    /**
     * @param HasIdRequest $request
     * @return Factory|View|Application
     */
    public function detail(HasIdRequest $request): Factory|View|Application
    {
        $service = $this->appService->appServiceRepository->find((int)$request->id);
        if (!$service) abort(404);
        return view('pages.dashboard.service.detail', compact('service'));
    }

    /**
     * @param UpdateServiceRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateServiceRequest $request): RedirectResponse
    {
        $status = $this->appService->appServiceRepository->update($request->id, $request->only(['name', 'home_link']));
        return back()->with([
            "updated" => $status
        ]);
    }

    /**
     * @param SearchRequest $request
     * @return Factory|View|Application
     */
    public function search(SearchRequest $request): Factory|View|Application
    {
        $query = $request->get("query");
        $services = $this->appService->appServiceRepository->search($query);
        $services->appends([
            "query" => $query
        ]);
        return view('pages.dashboard.service.service', compact('query', 'services'));
    }
}
