<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class UpdatePermissionRequest extends CoreRequest
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
        $id = $this->route('id');
        return [
            'name' 					=> "required|unique:permissions,name, $id",
            'nice_name' 		    => 'nullable',
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
            'name.required'    		        => __('core::core.form.validation.required'),
            'name.unique'    		        => __('core::core.form.validation.unique'),
        ];
    }
}
