<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
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
    #[ArrayShape(["email" => "array", "password" => "array"])]
    public function rules(): array
    {
        return [
            "email" => [
                Rule::requiredIf(function () {
                    return $this->isMethod("POST");
                })
            ],
            "password" => [
                Rule::requiredIf(function () {
                    return $this->isMethod("POST");
                })
            ]
        ];
    }
}
