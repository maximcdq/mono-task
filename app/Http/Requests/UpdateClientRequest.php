<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'client' => 'sometimes|array',
            'client.name' => 'sometimes|min:3|max:50',
            'client.sex' => 'sometimes',
            'client.address' => 'sometimes|min:3|max:50',
            'client.phone' => 'sometimes|min:3|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'client.name' => 'Недопустимое количество символов в поле ФИО, от 3 до 50!',
            'client.address' => 'Недопустимое количество символов, от 3 до 50!',
            'client.number' => 'Номер должен состоять из 9-и символов!'
        ];
    }
}
