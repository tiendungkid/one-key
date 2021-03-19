<?php

namespace App\Http\Controllers;

use App\Http\Requests\HasIdRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Services\AccountService\AccountService;
use App\Services\AppServices\AppService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{
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
        $attributes = $request->only(['name', 'password', 'two_fa_code', 'color', 'note_attributes', 'description', 'service_id']);
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

    public function update()
    {

    }

    public function import()
    {

    }

    public function export()
    {

    }
}
