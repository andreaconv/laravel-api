<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
      'name' => 'required|min:3|max:255',
      'description' => 'min:5',
      'category' => 'min:5|max:255'
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Il nome è un campo obbligatorio',
      'name.min' => 'Il nome deve avere almeno :min caratteri',
      'name.max' => 'Il nome deve avere massimo :max caratteri',
      'description.min' => 'La descrizione deve avere almeno :min caratteri',
      'category.min' => 'La categoria deve avere almeno :min caratteri',
      'category.max' => 'La categoria deve avere massimo :max caratteri'
    ];
  }
}
