<?php

namespace Iboinas\Backoffice\Http\Requests\Authority;

use App\Http\Requests\Request;

class LoginRequest extends Request
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
            'email'    => 'required|min:4|max:254',
            'password' => 'required|min:6'
        ];
    }
}
