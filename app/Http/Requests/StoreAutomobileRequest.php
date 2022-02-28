<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAutomobileRequest extends FormRequest
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
            'newCars' => 'sometimes|array',
            'newCars.*.id' => 'sometimes',
            'newCars.*.brand' => 'sometimes|min:1|max:50',
            'newCars.*.model' => 'sometimes|min:1|max:50',
            'newCars.*.color' => 'sometimes|min:3|max:50',
            'newCars.*.number' => 'sometimes|min:1|max:15|unique:App\Models\Automobile,number'
        ];
    }


    public function messages()
    {
        return [
            'newCars.*.brand' => 'Недопустимое количество символов, от 3 до 50!',
            'newCars.*.model' => 'Недопустимое количество символов, от 3 до 50!',
            'newCars.*.color' => 'Недопустимое количество символов, от 3 до 50!',
            'newCars.*.number' => 'Номер должен состоять минимум из 9-и символов!'
        ];
    }
}
