<?php


namespace App\Services\AccountService;

use App\Repositories\AccountRepository\AccountRepository;
use Illuminate\Support\Facades\File;

class AccountServiceImplementing implements AccountService
{

    public function __construct(public AccountRepository $accountRepository)
    {
    }

    public function export(): string
    {
        $account = $this->accountRepository
            ->all(['name', 'password', 'two_fa_code', 'color', 'attributes', 'description', 'service_id']);
        $folderPath = storage_path('downloads/json');
        File::isDirectory($folderPath) ?: File::makeDirectory($folderPath, 0777, true);
        $filePath = "{$folderPath}/accounts.json";
        if (!File::exists($filePath)) fopen($filePath, 'w');
        File::put($filePath, $account->toJson(JSON_PRETTY_PRINT));
        return $filePath;
    }
}
