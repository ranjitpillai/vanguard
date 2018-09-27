<?php

namespace Vanguard\Support\Enum;

class TransactionType
{
    const REVERSELOOKUP = 'Reverse Lookup';
    const REMOVEFROMCALLLIST = 'Request Removal from Call List';
    const REQUESTQUOTE = 'Request Quote';
    const BUSINESSMESSAGESENT = 'Business Text Message Sent';
    const ADDTOCALLLIST = 'Request Add To Call List';

    public static function lists()
    {
        return [
            self::REVERSELOOKUP => self::REVERSELOOKUP,
            self::REMOVEFROMCALLLIST => self::REMOVEFROMCALLLIST,
            self::REQUESTQUOTE => self::REQUESTQUOTE,
            self::BUSINESSMESSAGESENT => self::BUSINESSMESSAGESENT,
            self::ADDTOCALLLIST => self::ADDTOCALLLIST
        ];
    }
}