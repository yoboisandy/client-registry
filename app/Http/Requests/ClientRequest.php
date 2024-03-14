<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255"],
            "phone" => ["required", "string", "min:10", "max:10"],
            "address" => ["required", "string", "max:255"],
            "gender" => ["required", "string", "max:255", "in:male,female,other"],
            "nationality" => ["required", "string", "max:255"],
            "dob" => ["required", "date"],
            "education" => ["required", "string", "max:255"],
            "mode_of_contact" => ["required", "string", "max:255", "in:email,phone,none"],
            "image" => ["optional", "image", "mimes:jpeg,png,jpg,svg", "max:2048"],
        ];
    }
}
