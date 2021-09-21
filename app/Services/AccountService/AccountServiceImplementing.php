<?php


namespace App\Services\AccountService;

use App\Models\Account;
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
        $account = $this
            ->accountRepository
            ->getAll(['name', 'password', 'two_fa_code', 'color', 'attributes', 'description', 'service_id']);
        $folderPath = storage_path('downloads/json');
        File::isDirectory($folderPath) || File::makeDirectory($folderPath, 0777, true);
        $filePath = "$folderPath/accounts.json";
        if (!File::exists($filePath)) fopen($filePath, 'w');
        File::put($filePath, $account->toJson(JSON_PRETTY_PRINT));
        return $filePath;
    }

    public function import(string $filePath): int
    {
        $effected = 0;
        try {
            $contents = collect(json_decode(File::get($filePath, true)));
            $contents->map(function ($service) use (&$effected) {
                $attributes = collect($service)
                    ->only(['service_id', 'name', 'password', 'two_fa_code', 'color', 'attributes', 'description'])
                    ->toArray();
                $effected += $this->accountRepository->create($attributes) ? 1 : 0;
            });
        } catch (Exception $e) {
            logger()->error("Import account failed with message: {$e->getMessage()}");
        }
        return $effected;
    }
}
