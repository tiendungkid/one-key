<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SearchAccountRequest;
use App\Services\AccountService\AccountService;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class AccountController extends Controller
{
    public function __construct(
        protected AccountService $accountService
    )
    {
    }

    #[ArrayShape(["data" => "mixed"])]
    public function search(SearchAccountRequest $request): array
    {
        $host = $request->host;
        return [
            "data" => []
        ];
    }
}
