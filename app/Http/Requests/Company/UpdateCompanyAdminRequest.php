<?php

namespace Vanguard\Http\Requests\Company;

use Vanguard\Http\Requests\Request;
use Vanguard\Company;
use Auth;

class UpdateCompanyAdminRequest extends Request
{
   
    public function rules()
    {
        $company = Company::where("company_code",Auth::user()->present()->company_code)->first();
	
        return [
            'company_name' => 'required',
            'company_code' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:company,company_code,'.$company->id
        ];
    }
}
