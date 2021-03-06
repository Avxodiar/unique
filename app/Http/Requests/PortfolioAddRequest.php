<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioAddRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:64',
            'image' => 'required|max:128|mimes:gif,jpg,jpeg,png,svg',
            'filter' => 'required|max:64|regex:/(^[A-Za-z0-9-,\s]+$)+/'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation() {
        $this->merge([
            'filter' => strtoupper(trim(str_replace(', ', ',', $this->filter))),
        ]);
    }
}
