<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAutomobileRequest extends FormRequest
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
            'cars' => 'sometimes|array',
            'cars.*.id' => 'sometimes',
            'cars.*.brand' => 'sometimes|min:1|max:50',
            'cars.*.model' => 'sometimes|min:1|max:50',
            'cars.*.color' => 'sometimes|min:1|max:50',
            'cars.*.number' => 'sometimes|min:1|max:9'
        ];
    }


    public function messages(): array
    {
        return [
            'cars.*.brand' => 'Недопустимое количество символов, от 3 до 50!',
            'cars.*.model' => 'Недопустимое количество символов, от 3 до 50!',
            'cars.*.color' => 'Недопустимое количество символов, от 3 до 50!',
            'cars.*.number' => 'Номер должен состоять из 9-и символов!'
        ];
    }
}
