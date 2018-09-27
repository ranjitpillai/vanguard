<?php

namespace Vanguard\Http\Requests\Company;

use Vanguard\Http\Requests\Request;
use Vanguard\Company;

class UpdateAddressDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'street1' => 'required',
            'country_id' => 'required'
        ];
    }
}
