<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'artworkFile' => ['required', ' mimes:jpeg,png,gif', 'max:5120'],
            'artworkTitle' => ['required', 'max:254'],
            'artworkDescription' => [ 'max:254'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'artworkFile.required' => 'u moet een bestand selecteren',
            'artworkFile.mimes' => 'u moet een bestand selecteren met .pdf formaat',
            'artworkFile.max' => 'uw bestand moet kleiner zijn dan 5MB',
        ];
    }
}
