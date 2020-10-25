<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
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

//           'f_name' => 'required',
//            'address' => 'required',
//            'country' => 'required',
//            'state' => 'required',
//            'mobile' => 'required',
        ];
    }

    public function messages()
    {
        return [

//            'f_name.required' => 'Please enter first name.',
//            'address.required' => 'Please enter address.',
//            'country.required' => 'Please select country.',
//            'state.required'    => 'Please select state.',
//            'mobile.required' => 'Please enter mobile.',
        ];
    }
}
