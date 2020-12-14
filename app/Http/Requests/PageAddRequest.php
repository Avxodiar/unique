<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageAddRequest extends FormRequest
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
           'name' => 'required|max:128',
           'alias' => 'required|unique:pages|max:32',
           'content' => 'required',
           'images' => 'required|mimes:gif,jpg,jpeg,png,svg'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Поле обязательно к заполнению.',
            'unique' => 'Псевдоним должен быть уникальным. Запись с таким псевдонимом уже существует.',
            'max' => 'Длина должна быть не более :max символов.',
            'mimes' => 'Изображение должно быть в одном из следующих форматов: :values.'
        ];
    }
}
