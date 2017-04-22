<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
      // 'shippingMethodName' => 'required',
      // 'name' => 'required|regex:/^$/',
      // 'email' => 'required|email',
      // 'phone' => 'required|regex:/^((\+|00)[0-9]{2})?[0-9]{9}$/',
      // 'street' => 'required|regex:/^$[^\s]+ [0-9]{1,3}([a-zA-Z])?(\/[0-9]{1,3})?/',
      // 'city' => 'required|regex:/^[0-9]{2}-[0-9]{3} [^\s]{3,}$/',
    ];
  }
}
