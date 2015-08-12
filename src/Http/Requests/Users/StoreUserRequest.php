<?php

namespace Iboinas\Backoffice\Http\Requests\Users;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
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
            'first_name'    => 'required|min:2|max:50',
            'last_name'    => 'required|min:2|max:50',
            'email'    => 'required|email',
            'password'    => 'required|min:6|max:50|confirmed',
        ];
    }
}
