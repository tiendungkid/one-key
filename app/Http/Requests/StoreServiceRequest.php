<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class StoreServiceRequest extends FormRequest
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
    #[ArrayShape(["name" => "array", "home_link" => "string"])]
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "min:2",
                "max:20",
                Rule::unique("services", 'name')
            ],
            "home_link" => "required|min:2|max:20"
        ];
    }
}
