<?php


namespace App\Services\AccountService;

use App\Repositories\AccountRepository\AccountRepository;
use Exception;
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

    public function import(string $filePath): int
    {
        $effected = 0;
        try {
            $contents = collect(json_decode(File::get($filePath, true)));
            $contents = $contents->map(function ($service) {
                return collect($service)->only(['service_id', 'name', 'password', 'two_fa_code', 'color', 'attributes', 'description'])->toArray();
            })->toArray();
            $effected += $this->accountRepository->insert($contents);
        } catch (Exception $e) {
            logger()->error("Import account failed with message: {$e->getMessage()}");
        }
        return $effected;
    }
}
