<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
            'sort' => 'nullable|string|in:id,name,status,gender,race',
            'order' => 'nullable|in:asc,desc',
            'gender.*' => 'nullable|string|in:male,female',
            'status.*' => 'nullable|string|in:alive,dead',
            'race.*' => 'nullable|string|in:human,alien,robot,humanoid,animal',
        ];
    }
}
