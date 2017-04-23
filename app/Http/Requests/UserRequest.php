<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
      'name' => 'required|regex:/^[^\s]{3,} [^\s]{3,}$/',
      'email' => ['required',
      Rule::unique('users')->ignore($this->id),
      'max:255'],
      'phone_number' => ['required', 'regex:/((\+|00)[0-9]{2})?[0-9]{9}/'],
      'street' => 'required|regex:/^[^\s]+ [0-9]{1,3}([a-zA-Z])?(\/[0-9]{1,3})?$/',
      'city' => 'required|regex:/^[0-9]{2}-[0-9]{3} [^\s]{3,}$/',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => __('Field name is required'),
      'email.unique' => __('The email has already been taken'),
      'phone_number.required' => __('Field phone_number is required'),
      'street.required' => __('Field street is required'),
      'city.required' => __('Field city is required'),
    ];
  }
}
