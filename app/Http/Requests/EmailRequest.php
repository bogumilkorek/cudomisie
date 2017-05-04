<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmailRequest extends FormRequest
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
      'email' => 'required|email',
      'phone' => ['required', 'regex:/^((\+|00)[0-9]{2})?[0-9]{9}$/'],
      'messageContent' => 'required|min:20'
    ];
  }

  public function messages()
  {
    return [
      'name.required' => __('Field name is required'),
      'email.required' => __('Field email is required'),
      'phone.required' => __('Field phone is required'),
      'messageContenct.required' => __('Field contenct is required'),
    ];
  }
}
