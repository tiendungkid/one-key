<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

class UserController extends Controller
{
    #[ArrayShape(["message" => "string"])]
    public function checkIsValidAccessToken(): array
    {
        return [
            "message" => "success"
        ];
    }
}
