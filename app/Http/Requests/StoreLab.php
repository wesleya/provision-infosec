<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreLab extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ip' => 'required|ip',
            'ttl' => 'required|integer|between:1,6',
        ];
    }

    public function messages()
    {
        return [
            'ip.required' => 'IP Address is required',
            'ip.ip' => 'Must be a valid IP Address',
            'ttl.required'  => 'Time to live is required',
            'ttl.between'  => 'Time to live must be a value between 1 and 6',
        ];
    }
}
