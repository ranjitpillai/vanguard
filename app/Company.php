<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{   
    protected $table = 'company';

    protected $fillable = ['company_name', 'company_details', 'avatar', 'company_address', 'company_website', 'company_phone', 'company_code','company_fax','street1','city','state','address','street2','postal_code','state_code','country_id','facebook','twitter','google_plus','linked_in','dribbble','skype'];

    public function users()
    {
        return $this->hasMany(User::class, 'company_code');
    }
}
