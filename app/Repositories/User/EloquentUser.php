<?php

namespace Vanguard\Repositories\User;

use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Role;
use Vanguard\Services\Auth\Social\ManagesSocialAvatarSize;
use Vanguard\Services\Upload\UserAvatarManager;
use Vanguard\User;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Database\SQLiteConnection;
use Laravel\Socialite\Contracts\User as SocialUser;

class EloquentUser implements UserRepository
{
    use ManagesSocialAvatarSize;

    /**
     * @var UserAvatarManager
     */
    private $avatarManager;
    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(UserAvatarManager $avatarManager, RoleRepository $roles)
    {
        $this->avatarManager = $avatarManager;
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
	public function findByUsername($username)
    {
        return User::where('username', $username)->first();
    }
	
	public function findByEmailToken($token)
    {
        return User::where('confirmation_token', $token)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function findBySocialId($provider, $providerId)
    {
        return User::leftJoin('social_logins', 'users.id', '=', 'social_logins.user_id')
            ->select('users.*')
            ->where('social_logins.provider', $provider)
            ->where('social_logins.provider_id', $providerId)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function findBySessionId($sessionId)
    {
        return User::leftJoin('sessions', 'users.id', '=', 'sessions.user_id')
            ->select('users.*')
            ->where('sessions.id', $sessionId)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function associateSocialAccountForUser($userId, $provider, SocialUser $user)
    {
        return DB::table('social_logins')->insert([
            'user_id' => $userId,
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'avatar' => $this->getAvatarForProvider($provider, $user),
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = User::query();

        if ($status) {
            $query->where('status', $status);
        }
		
		if(!Auth::user()->hasRole('Admin')){
			if(Auth::user()->hasRole('CompanyAdmin')){
				$query->where('company_code', Auth::user()->company_code);
			}
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

        if ($status) {
            $result->appends(['status' => $status]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
	
        if (isset($data['country_id']) && $data['country_id'] == 0) {
            $data['country_id'] = null;
        }

        $user = $this->find($id);

        $user->update($data);

        return $user;
    }
     public function updateSocialNetworks($userId, array $data)
    {
        return $this->find($userId)->socialNetworks()->updateOrCreate([], $data);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $user = $this->find($id);

        $this->avatarManager->deleteAvatarIfUploaded($user);

        return $user->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return User::count();
    }

    /**
     * {@inheritdoc}
     */
    public function newUsersCount()
    {
        return User::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }

    /**
     * {@inheritdoc}
     */
    public function countByStatus($status)
    {
        return User::where('status', $status)->count();
    }

    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return User::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function countOfNewUsersPerMonth(Carbon $from, Carbon $to)
    {
        $result = User::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($user) {
                return $user->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            $key = $from->format("Y_n");

            $counts[$this->parseDate($key)] = count($result->get($key, []));

            $from->addMonth();
        }

        return $counts;
    }

    /**
     * Parse date from "Y_m" format to "{Month Name} {Year}" format.
     * @param $yearMonth
     * @return string
     */
    private function parseDate($yearMonth)
    {
        list($year, $month) = explode("_", $yearMonth);

        $month = trans("app.months.{$month}");

        return "{$month} {$year}";
    }

    /**
     * {@inheritdoc}
     */
    public function getUsersWithRole($roleName)
    {
        return Role::where('name', $roleName)
            ->first()
            ->users;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserSocialLogins($userId)
    {
        return DB::table('social_logins')
            ->where('user_id', $userId)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function setRole($userId, $roleId)
    {
        return $this->find($userId)->setRole($roleId);
    }

   
	/**
     * {@inheritdoc}
     */
    public function setDeviceId($userId, $deviceId)
    {
        return DB::table('user_devices')->insert([
            'user_id' => $userId,
            'device_id' => $deviceId,
        ]);
    }
	
    /**
     * {@inheritdoc}
     */
    public function findByConfirmationToken($token)
    {
        return User::where('confirmation_token', $token)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function switchRolesForUsers($fromRoleId, $toRoleId)
    {
        return User::where('role_id', $fromRoleId)
            ->update(['role_id' => $toRoleId]);
    }
	
	
	public function addDevice($data){
	
		$row = DB::table('user_devices')
			->where('device_id', $data['phone_number'].'#'.$data['device_id'])
			->first();
		
		if(count($row) > 0){
			$record["success"] = 0;
			$record["message"] = "Device Already Registered";
			return $record;
		} else {
			$token = mt_rand(111111,999999);
			$insert = array(
				'user_id' => $data["user_id"],
				'device_id' => $data['phone_number'].'#'.$data['device_id'],
				'IMEI' => $data['device_id'],
				'phone_number' => $data['phone_number'],
				'country_code' => $data['country_code'],
				'status' => $data["status"],
				'os_api_level' => $data["os_api_level"],
				'device' => $data["device"],
				'model' => $data["model"],
				'manufacturer' => $data["manufacturer"],
				'brand' => $data["brand"],
				'display' => $data["display"],
				'os_version' => $data["os_version"],
				'sms_token' => $token,
			);
			DB::table('user_devices')->insert($insert);
			
			$row = DB::table('user_devices')->where('device_id', $data['phone_number'].'#'.$data['device_id'])->first();
			$record["success"] = 1;
			$record["data"] = $row;
			$record["message"] = "Device Added!";
			$record["token"] = $token;
			return $record;
		}
		
	}
	
	public function get_devices($user_id){
		$devices = DB::table('user_devices')
			->where('user_id', $user_id)
			->get();
		
		return $devices;
	}
	
	public function verify_sms($data){
		$row = DB::table('user_devices')
			->where('user_id', $data['user_id'])
			->where('phone_number', $data['phone_number'])
			->where('device_id', $data['phone_number']."#".$data['device_id'])
			->where('sms_token', $data['sms_token'])
			->first();
		$json = array();	
		if(empty($row)){
			$json["success"] = 0;
			$json["message"] = "Token does not match!";
		} else {
			
			DB::table('user_devices')
				->where('user_id', $data['user_id'])
				->where('phone_number', $data['phone_number'])
				->where('device_id', $data['phone_number']."#".$data['device_id'])
				->where('sms_token', $data['sms_token'])
				->update(['status' => $data["status"]]);
				
			$row = DB::table('user_devices')
			->where('user_id', $data['user_id'])
			->where('phone_number', $data['phone_number'])
			->where('device_id', $data['phone_number']."#".$data['device_id'])
			->where('sms_token', $data['sms_token'])
			->first();
				
			$json["success"] = 1;
			$json["message"] = "Verified";
			$json["data"] = $row;
		}
		
		return $json;
	}
	
	public function resend_token($data){
		$token = mt_rand(111111,999999);
		$update = array(
			'user_id' => $data["user_id"],
			'device_id' => $data['phone_number'].'#'.$data['device_id'],
			'phone_number' => $data['phone_number'],
			'country_code' => $data['country_code'],
		);
		
		$u = DB::table('user_devices')->where($update)->update(['status' => $data["status"],'sms_token' => $token]);
		
		if($u){
			$row = DB::table('user_devices')->where('device_id', $data['phone_number'].'#'.$data['device_id'])->first();
			$json["success"] = 1;
			$json["data"] = $row;
			$json["message"] = "SMS Send Again";
			$json["sms_token"] = $token;
			return $json;
		} else {
			$json["success"] = 0;
			$json["message"] = "Device not registered!";
			return $json;
		}
		
	}
	
	public function findByApiToken($user_id, $api_token)
    {
        return User::where('id', $user_id)->where("api_token",$api_token)->first();
    }

	
}
