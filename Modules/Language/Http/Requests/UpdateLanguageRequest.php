<?php

namespace Modules\Language\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class UpdateLanguageRequest extends CoreRequest
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
			'name' 		    => "required",
            'default' 		=> 'nullable',
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
            'default.required'    	=> __('core::core.form.validation.required'),
        ];
    }
}
