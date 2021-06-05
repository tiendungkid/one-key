<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Services\AppServices\AppService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('pages.dashboard.service.service');
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return view('pages.dashboard.service.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreServiceRequest $request
     * @return RedirectResponse
     */
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $status = $this->appService->appServiceRepository->create($request->only(['name', 'home_link']));
        if (!$status) return back()->withErrors([
            "Something wrong !"
        ]);
        return redirect()->route('services.show', $status->id);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): Factory|View|Application
    {
        $service = $this->appService->appServiceRepository->find($id);
        if (!$service) abort(404);
        return view('pages.dashboard.service.detail', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateServiceRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateServiceRequest $request, int $id): RedirectResponse
    {
        $status = $this->appService->appServiceRepository->update($id, $request->only(['name', 'home_link']));
        return back()->with([
            "updated" => $status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $status = $this->appService->appServiceRepository->delete($id);
        session()->flash('deleted', $status);
        return redirect()->route('services.index', compact('status'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function truncate(): BinaryFileResponse
    {
        $filePath = $this->appService->exportToJsonFile();
        if (!$filePath) abort(500);
        $this->appService->appServiceRepository->truncate();
        return response()->download($filePath)->deleteFileAfterSend();
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
     * @param ImportServiceRequest $request
     * @return View|Factory|RedirectResponse|Application
     */
    public function import(ImportServiceRequest $request): View|Factory|RedirectResponse|Application
    {
        if ($request->isMethod('GET')) return view('pages.dashboard.service.import');
        $file = $request->file('file');
        $effected = $this->appService->importFromJsonFile($file->getRealPath());
        session()->flash('effected', $effected);
        return redirect()->route('services.import');
    }

    /**
     * Get datable
     * @return JsonResponse
     */
    public function datatable(): JsonResponse
    {
        try {
            return datatables()->eloquent(
                $this
                    ->appService
                    ->appServiceRepository
                    ->select()
                    ->withCount('accounts')
            )->make();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
