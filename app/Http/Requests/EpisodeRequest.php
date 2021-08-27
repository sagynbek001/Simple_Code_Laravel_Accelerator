<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'season' => 'required|nullable|numeric',
            'series' => 'required|nullable|numeric',
            'premiere' => 'required|date_format:"Y-m-d"',
            'description' => 'required|string|max:10000',
        ];
    }
}
