<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'title' => ['required', 'string', 'max: 50'],
            'cook_time' => ['required', 'integer'],
            'ingredients' => ['required', 'string', 'max: 500'],
            'description' => ['required', 'string', 'max: 1000'],
            'comment' => ['string', 'max: 1000'],
            'cooking_img_file' => ['file', 'image'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => '料理名',
            'cook_time' => '調理時間',
            'ingredients' => '材料',
            'description' => '作り方',
        ];
    }
}