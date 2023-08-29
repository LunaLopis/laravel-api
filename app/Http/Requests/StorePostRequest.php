<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|max:50',
            'type_id' => 'required|exists:types,id',
            'tecnology_id' => 'exists:tecnology,id',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'il titolo è obbligatorio',
            'title.max' => 'il titolo deve essere lungo massimo :max caratteri',
             'type_id.required' => 'Devi selezionare una categoria',
             'type_id.exists' => 'categoria selezionata non valida',
             'tecnology_id.exists' => 'tecnologia selezionata non valida',
        ];
    }
}
