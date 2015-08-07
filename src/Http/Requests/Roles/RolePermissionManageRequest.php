<?php

namespace Iboinas\Backoffice\Http\Requests\Roles;

use App\Http\Requests\Request;

class RolePermissionManageRequest extends Request
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
        if(\Request::isMethod('POST'))
        return [
            'name'    => 'required|min:4|max:50',
            'permission_type' => 'required|min:2'
        ];
        else return [];
    }
}
