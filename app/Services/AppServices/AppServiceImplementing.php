<?php


namespace App\Services\AppServices;

use App\Repositories\AppServiceRepository\AppServiceRepository;
use Exception;
use Illuminate\Support\Facades\File;

class AppServiceImplementing implements AppService
{
    public function __construct(public AppServiceRepository $appServiceRepository)
    {
    }

    public function importFromJsonFile(string $filePath): int
    {
        $effected = 0;
        try {
            $contents = collect(json_decode(File::get($filePath, true)));
            $contents = $contents->map(function ($service) {
                return collect($service)->only(['name', 'home_link'])->toArray();
            })->toArray();
            $effected += $this->appServiceRepository->insert($contents);
        } catch (Exception $e) {
            logger()->error("Import service failed with message: {$e->getMessage()}");
        }
        return $effected;
    }

    public function exportToJsonFile(): ?string
    {
        try {
            $service = $this->appServiceRepository->all(['name', 'home_link']);
            $folderPath = storage_path('downloads/json');
            File::isDirectory($folderPath) ?: File::makeDirectory($folderPath, 0777, true);
            $filePath = "{$folderPath}/services.json";
            if (!File::exists($filePath)) fopen($filePath, 'w');
            File::put($filePath, $service->toJson(JSON_PRETTY_PRINT));
            return $filePath;
        } catch (Exception) {
            return null;
        }
    }
}
