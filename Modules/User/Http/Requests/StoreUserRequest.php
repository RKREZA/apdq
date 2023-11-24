<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class StoreUserRequest extends CoreRequest
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
            'name' 			=> 'required',
			'email' 		=> 'required|email|unique:users,email',
			'mobile' 		=> 'required|string|unique:users,mobile',
			'password' 		=> 'required|same:password_confirmation',
			'roles' 		=> 'required',
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
            'name.required'    		=> __('core::core.form.validation.required'),
            'email.required'    	=> __('core::core.form.validation.required'),
            'email.email'    		=> __('core::core.form.validation.email'),
            'email.unique'    		=> __('core::core.form.validation.unique'),
            'mobile.required'    	=> __('core::core.form.validation.required'),
            'mobile.unique'    	    => __('core::core.form.validation.unique'),
            'password.required'    	=> __('core::core.form.validation.required'),
            'password.same'    		=> __('core::core.form.validation.same'),
            'roles.required'    	=> __('core::core.form.validation.required'),
        ];
    }
}
