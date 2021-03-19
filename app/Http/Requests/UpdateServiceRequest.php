<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateServiceRequest extends FormRequest
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
    #[ArrayShape(["name" => "string", "home_link" => "string"])]
    public function rules(): array
    {
        return [
            "name" => "required|min:2|max:20",
            "home_link" => "required|min:2|max:20"
        ];
    }
}
