<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HasServiceIdRequest;
use App\Http\Requests\ImportAccountRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Services\AccountService\AccountService;
use App\Services\AppServices\AppService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AccountController extends Controller
{
    /**
     * @param AccountService $accountService
     * @param AppService $appService
     */
    public function __construct(
        protected AccountService $accountService,
        protected AppService     $appService
    )
    {
    }

    public function index(): Application|Factory|View
    {
        return view('pages.dashboard.account.index');
    }

    public function create(HasServiceIdRequest $request)
    {
        $service = $this->appService->appServiceRepository->findOrFail($request->id);
        return view('pages.dashboard.account.create', compact('service'));
    }

    /**
     * @param StoreAccountRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAccountRequest $request): RedirectResponse
    {
        $account = $this->accountService->accountRepository->create($request->all());
        if (!$account) return back()->withErrors(["Something wrong !"]);
        return redirect()->route('accounts.show', $account->id);
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): View|Factory|Application
    {
        $account = $this->accountService->accountRepository->find($id);
        return view('pages.dashboard.account.show', compact('account'));
    }

    /**
     * @param UpdateAccountRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateAccountRequest $request, int $id): RedirectResponse
    {
        $status = $this->accountService->accountRepository->update($id, $request->all());
        if (!$status) return back()->withErrors([
            "Something wrong !"
        ]);
        session()->flash('updated', true);
        return back();
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(int $id, Request $request): RedirectResponse
    {
        $status = $this->accountService->accountRepository->delete($id);
        if (!$status) return back()->withErrors(['Something wrong !']);
        else {
            return $request->has('service_id') ?
                redirect()->route('accounts.list', ['id' => $request->service_id]) :
                redirect()->route('services.index');
        }
    }

    /**
     * @return RedirectResponse
     */
    public function truncate(): RedirectResponse
    {
        $this->accountService->accountRepository->truncate();
        return back();
    }

    /**
     * @param ImportAccountRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function import(ImportAccountRequest $request): Factory|View|Application|RedirectResponse
    {
        if ($request->isMethod('GET')) {
            return view('pages.dashboard.account.import');
        }
        $file = $request->file('file');
        $effected = $this->accountService->import($file->getRealPath());
        session()->flash('imported', $effected);
        return redirect()->route("accounts.index");
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        $filePath = $this->accountService->export();
        return response()->download($filePath)->deleteFileAfterSend();
    }

    public function list(HasServiceIdRequest $request)
    {
        $service = $this->appService->appServiceRepository->findOrFail($request->id);
        $accounts = $this->accountService->accountRepository->allAccountOfService($request->id);
        return view('pages.dashboard.account.list', compact('accounts', 'service'));
    }
}
