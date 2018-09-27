<?php

namespace Vanguard\Repositories\Transaction;

use Vanguard\Transaction;
use Vanguard\Support\Enum\TransactionType;
use DB;

class EloquentTransaction implements TransactionRepository
{
    
	public function paginate($perPage, $search = null, $status = null)
    {
        $query = Transaction::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', "like", "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
                $q->orWhere('first_name', 'like', "%{$search}%");
                $q->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $result = $query->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }
	
    public function find($id)
    {
        return Transaction::find($id);
    }
	
	public function findByUser($id,$search_phone,$search_date,$device_number,$transaction_type)
    {
		$query = Transaction::query();
		$query->where('user_id', $id);
        if ($search_phone && $search_phone!="") {
            $query->where('phone_number', "like", "%{$search_phone}%");
        }
		
        if ($search_date && $search_date!="") {
            $query->where('created_at', "like", "%{$search_date}%");
        }
		
        if ($device_number && $device_number!="" && $device_number!=0) {
            $query->where('device_id',$device_number);
        }
		
        if ($transaction_type && $transaction_type!="") {
            $query->where('transaction_type',$transaction_type);
        }
		
		$result = $query->orderBy('created_at', 'desc')
						->get();
		
		return $result;
    }

	public function findByDeviceID($id)
    {
        return Transaction::where('device_id', $id)->orderBy('id', 'desc')->get();
    }
	
	public function findByTransactionType($type)
    {
        return Transaction::where('transaction_type', $type)->get();
    }
	
	public function findByPhoneNumber($phone_number)
    {
        return Transaction::where('phone_number', $phone_number)->where("transaction_type",TransactionType::REVERSELOOKUP)->first();
		
		
    }
	
	public function create($data)
    {
        return Transaction::create($data);
    }

}
