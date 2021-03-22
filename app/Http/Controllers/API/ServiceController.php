<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SearchAccountRequest;
use App\Services\AppServices\AppService;
use JetBrains\PhpStorm\ArrayShape;

class ServiceController extends Controller
{
    public function __construct(
        protected AppService $appService
    )
    {
    }

    /**
     * @param SearchAccountRequest $request
     * @return array
     */
    #[ArrayShape(["data" => "\Illuminate\Database\Eloquent\Collection"])]
    public function searchAccountByService(SearchAccountRequest $request): array
    {
        $host = $request->host;
        return [
            "data" => $this->appService->appServiceRepository->searchAccountByServiceName($host)
        ];
    }
}
