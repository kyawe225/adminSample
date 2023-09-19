<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"required|string",
            "email"=>"nullable|email",
            "logo"=>"mimes:jpg,png,jpeg|nullable|dimensions:min_width:100,min_height:100",
            "website"=>"url:http,https|nullable",
        ];
    }


}
