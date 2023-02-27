<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTypeInformationRequest extends FormRequest
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
            //
        ];
    }

    public function passedValidation()
    {
//        $name = $this->route()->name;
//        $this->merge([
//            'postType' => collect(config('posttypes'))->firstWhere('slug', $name)
//        ]);

    }
}
