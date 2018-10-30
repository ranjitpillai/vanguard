<?php

namespace Vanguard\Http\Requests\Company;

use Vanguard\Http\Requests\Request;

class UpdateCompanyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $company = $this->route('company');

        return [
            'company_name' => 'required',
            'company_code' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:company,company_code,'.$company->id
        ];
    }
}
