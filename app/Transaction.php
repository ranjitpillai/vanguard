<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
	protected $fillable = [
        'user_id', 'device_id', 'transaction_type', 'latitude', 'longitude','charge' ,'service_type', 'phone_number','name','note'
    ];
	
	public function details(){
        return $this->hasMany('Vanguard\TransactionDetails');
    }

}
