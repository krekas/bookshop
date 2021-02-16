<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required',
            'price' => 'required',
            'authors' => 'required'
        ];
    }

    public function validated()
    {
        if (auth()->user()->admin)
        {
            return array_merge(parent::validated(), [
                'approved' => true
            ]);
        }
    }
}
