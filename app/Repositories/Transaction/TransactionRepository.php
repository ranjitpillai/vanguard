<?php

namespace Vanguard\Repositories\Transaction;

use Vanguard\Transaction;
use \Laravel\Socialite\Contracts\User as SocialUser;

interface TransactionRepository
{
    /**
     * Paginate registered users.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);

    /**
     * Find user by its id.
     *
     * @param $id
     * @return null|User
     */
    public function find($id);

    /**
     * Find user by email.
     *
     * @param $email
     * @return null|User
     */
    public function findByUser($id,$search_phone,$search_date,$device_number,$transaction_type);
	
    public function findByDeviceID($id);
	
    public function findByTransactionType($type);
	
    public function create($data);
	
    public function findByPhoneNumber($phone_number);
	
}