<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    protected $table = 'transaction_details';
	
	protected $fillable = [
        'transaction_id', 'key_name', 'value'
    ];
	public function Transaction(){
        return $this->belongsTo('App\Transaction');
    }
}
