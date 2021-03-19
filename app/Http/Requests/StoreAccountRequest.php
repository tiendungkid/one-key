<?php

namespace App\Http\Requests;

use App\Rules\UniqueAccountName;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    #[ArrayShape(["name" => "array", "password" => "string[]", "service_id" => "string[]"])]
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                new UniqueAccountName($this->service_id ?? 0),
                "min:2",
                "max:50"
            ],
            "password" => [
                "required",
                "min:2",
                "max:50"
            ],
            "service_id" => [
                "required",
                "numeric"
            ]
        ];
    }

}
