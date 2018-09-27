<?php

namespace Vanguard\Http\Requests\Company;

use Vanguard\Http\Requests\Request;

class CreateCompanyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required'
        ];
    }
}
