<?php

namespace Modules\Language\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class StoreLanguageRequest extends CoreRequest
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
			'name' 			        => 'required|string',
            'code' 					=> 'required|unique:languages,code',
			'default' 			    => 'nullable|string',
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
            'code.required'    	=> __('core::core.form.validation.required'),
            'code.code'    		=> __('core::core.form.validation.code'),
            'code.unique'    		=> __('core::core.form.validation.unique'),
            'default.required'    	=> __('core::core.form.validation.required'),
        ];
    }
}
