<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
      'title' => ['required',
      Rule::unique('products')->ignore($this->id),
      'max:255'],
      'description' => 'required',
      'categories' => 'required',
      'price' => 'required|regex:/^[0-9]{1,3}\.[0-9]{2} .{1,3}$/',
      'dimensions' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'title.required' => __('Field title is required'),
      'title.unique' => __('The title has already been taken'),
      'description.required' => __('Field description is required'),
      'categories.required' => __('Field categories is required'),
      'price.required' => __('Field price is required'),
      'dimensions.required' => __('Field dimensions is required'),
    ];
  }
}
