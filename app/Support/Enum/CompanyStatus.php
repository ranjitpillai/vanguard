<?php

namespace Vanguard\Support\Enum;

class CompanyStatus
{
    
    const ACTIVE = 'Active';
    const PENDING = 'Pending';
    const INACTIVE = 'Inactive';
    public static function lists()
    {
        return [
            self::ACTIVE => trans('app.'.self::ACTIVE),
            self::PENDING => trans('app.'. self::PENDING),
            self::INACTIVE => trans('app.' . self::INACTIVE)
        ];
    }
}
