<?php

namespace Vanguard\Events\Company;

use Vanguard\Company;

abstract class CompanyEvent
{
    /**
     * @var Role
     */
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @return Role
     */
    public function getCompany()
    {
        return $this->company;
    }
}