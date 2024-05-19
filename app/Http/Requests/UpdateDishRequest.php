<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
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
            'dish_name' => 'required|string|max:50',
            'dish_price' => 'required|numeric|min:0|max:999,99',
            'ingredients' => 'nullable',
            'visible' => 'nullable|boolean',
            'dish_image' => 'file|max:3000|nullable|mimes:jpg,bmp,png',
        ];
    }

    public function messages(): array
    {
        return [

            'dish_name.required' => 'Il nome del piatto è obbligatorio',
            'dish_name.max' => 'Il nome del piatto può avere massimo :max caratteri',

            'dish_price.required' => 'Il prezzo del piatto è obbligatorio inserirlo',
            'dish_price.min' => 'Il prezzo non può essere negativo',
            'dish_price.max' => 'Il prezzo massimo consentito è 999.99 €',

            'dish_image.file' => "L'immagine del ristorante deve essere un file",
            'dish_image.max' => "La dimensione del file non deve superare i 3000 KB",
            'dish_image.mimes' => "Il file deve essere un'immagine con estensione jpg, bmp o png",


        ];
    }
}
