<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => ['required'],
            'status' => ['required', 'boolean'],
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'regex:/^[0-9]+$/i'],
            'items.*.quantity' => ['required', 'min:1'],
        ];
    }
}
