<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules =  [
            "name" => 'required',
            "gender" => 'required',
            "birth_date" => "required|date",
            "description" => "required|string",
            "lat" => "required",
            "lng" => "required",
            "type" => "required",
            "images.*" => "image"
        ];

        if ($this->isMethod('post')) {
            $rules["images"] = "required|array|min:1" ;
        }


        return $rules;
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['user_id'] = \Auth::id();
        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance(); // TODO: Change the autogenerated stub
    }
}
