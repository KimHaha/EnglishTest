<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// model
use App\Role;

use Illuminate\Support\Facades\Input;

class UpdateRolePut extends FormRequest
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
        $url = url()->current();
        $parse_result = explode('/',$url);
        $id = end($parse_result);

        $role = Role::where('id', '=', $id)->first();

        $input_fields = Input::all();
        $name = $input_fields['name'];

        if ($name == $role->name) {
            return [];
        }

        return [
            'name' => 'required|unique:roles',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.unique'  => 'A name must be unique',
        ];
    }
}
