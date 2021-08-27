<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'type' => 'required|string|in:world,planet,sector,base,micro-universe',
            'dimension' => 'required|string|in:c-137,replaced,5-126',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:10000',
        ];
    }
}
