<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class StoreRoleRequest extends CoreRequest
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
            'name' 					=> 'required|unique:roles,name',
			'permission' 			=> 'required',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'    		=> __('user::role.form.validation.name.required'),
            'name.unique'    		=> __('user::role.form.validation.name.unique'),
            'permission.required'   => __('user::role.form.validation.permission.required'),
        ];
    }
}
