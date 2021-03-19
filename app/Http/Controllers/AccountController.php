<?php

namespace App\Http\Controllers;

use App\Http\Requests\HasIdRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Services\AccountService\AccountService;
use App\Services\AppServices\AppService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AccountController extends Controller
{
    protected array $requestOnly = ['name', 'password', 'two_fa_code', 'color', 'note_attributes', 'description', 'service_id'];

    /**
     * AccountController constructor.
     * @param AccountService $accountService
     */
    public function __construct(protected AccountService $accountService)
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function show(): Factory|View|Application
    {
        return view('pages.dashboard.account.account');
    }

    /**
     * @param HasIdRequest $request
     * @param AppService $appService
     * @return Factory|View|Application
     */
    public function new(HasIdRequest $request, AppService $appService): Factory|View|Application
    {
        $service = $appService->appServiceRepository->find($request->id);
        abort_if(!$service, 404);
        return view('pages.dashboard.account.new', compact('service'));
    }

    /**
     * @param StoreAccountRequest $request
     * @return Factory|View|Application|RedirectResponse
     */
    public function store(StoreAccountRequest $request): Factory|View|Application|RedirectResponse
    {
        $attributes = $request->only($this->requestOnly);
        $account = $this->accountService->accountRepository->create($attributes);
        if (!$account) return back()->withErrors(["Something wrong !"]);
        return redirect()->route('accounts.detail', ['id' => $account->id]);
    }

    /**
     * @param HasIdRequest $request
     * @return Factory|View|Application
     */
    public function detail(HasIdRequest $request): Factory|View|Application
    {
        $account = $this->accountService->accountRepository->find($request->id);
        abort_if(!$account, 404);
        return view('pages.dashboard.account.detail', compact('account'));
    }

    /**
     * @param HasIdRequest $request
     * @param AppService $appService
     * @return Factory|View|Application
     */
    public function list(HasIdRequest $request, AppService $appService): Factory|View|Application
    {
        $service = $appService->appServiceRepository->find($request->id);
        abort_if(!$service, 404);
        $accounts = $this->accountService->accountRepository->allAccountOfService($request->id);
        return view('pages.dashboard.account.accounts', compact('accounts', 'service'));
    }

    /**
     * @param UpdateAccountRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateAccountRequest $request): RedirectResponse
    {
        $status = $this->accountService->accountRepository->update($request->id, $request->only($this->requestOnly));
        if (!$status) return back()->withErrors([
            "Something wrong !"
        ]);
        return back();
    }

    /**
     * @param HasIdRequest $request
     * @return RedirectResponse
     */
    public function delete(HasIdRequest $request): RedirectResponse
    {
        $status = $this->accountService->accountRepository->delete((int)$request->id);
        if (!$status) return back()->withErrors(['Something wrong !']);
        else {
            return $request->has('service_id') ?
                redirect()->route('accounts.list', ['id' => $request->service_id]) :
                redirect()->route('accounts');
        }
    }

    public function import()
    {

    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        $filePath = $this->accountService->export();
        return response()->download($filePath)->deleteFileAfterSend();
    }
}
