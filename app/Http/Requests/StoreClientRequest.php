<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'client.cars' => 'sometimes|array|min:1',
            'client.cars.*.brand' => 'sometimes|min:1|max:30',
            'client.cars.*.model' => 'sometimes|min:1|max:30',
            'client.cars.*.color' => 'sometimes|min:3|max:25',
            'client.cars.*.number' => 'sometimes|min:1|max:15|unique:App\Models\Client,number'
        ];
    }

    public function messages(): array
    {
        return [
            'client.name' => 'Недопустимое количество символов в поле ФИО, от 3 до 50!',
            'client.address' => 'Недопустимое количество символов, от 3 до 50!',
            'client.cars' => 'Заполните, хотя бы один автомобиль',
            'client.cars.*.color' => 'Недопустимое количество символов, от 3 до 50!',
            'client.cars.*.brand' => 'Недопустимое количество символов, от 3 до 50!',
            'client.cars.*.model' => 'Недопустимое количество символов, от 3 до 50!',
            'client.cars.*.number' => 'Номер должен состоять из 9-и символов!'
        ];
    }
}
