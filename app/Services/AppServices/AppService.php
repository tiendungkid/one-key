<?php


namespace App\Services\AppServices;

use App\Repositories\AppServiceRepository\AppServiceRepository;

/**
 * @property AppServiceRepository $appServiceRepository
 */
interface AppService
{
    /**
     * AppService constructor.
     * @param AppServiceRepository $appServiceRepository
     */
    public function __construct(AppServiceRepository $appServiceRepository);

    /**
     * Import by json file
     * @param string $filePath
     * @return int
     */
    public function importFromJsonFile(string $filePath): int;
}
