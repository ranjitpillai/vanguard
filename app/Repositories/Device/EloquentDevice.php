<?php

namespace Vanguard\Repositories\Device;

use Vanguard\User;
use Vanguard\Device;
use Carbon\Carbon;
use DB;
use Illuminate\Database\SQLiteConnection;


class EloquentDevice implements DeviceRepository
{
    /**
     * @var UserAvatarManager
     */
    private $avatarManager;
    /**
     * @var RoleRepository
     */
    private $roles;
/* 
    public function __construct(UserAvatarManager $avatarManager, RoleRepository $roles)
    {
        $this->avatarManager = $avatarManager;
        $this->roles = $roles;
    }
 */
    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Device::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findByDeviceID($device_id)
    {
        return Device::where('device_id', $device_id)->first();
    }
	
	/**
     * {@inheritdoc}
     */
    public function getDeviceByToken($data)
    {
        return Device::where('device_id', $data["user_id"]."#".$data["IMEI"]."#".$data["phone_number"])->where("sms_token",$data["sms_token"])->first();
    }
	
	public function findByEmailToken($token)
    {
        return User::where('email_token', $token)->first();
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
    public function create(array $data)
    {
		return Device::create($data);
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
            'avatar' => $user->getAvatar(),
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

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        return $this->find($id)->update($data);
    }

    /**
     * {@inheritdoc}
     */
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
    public function countOfNewUsersPerMonth($from, $to)
    {
        $perMonthQuery = $this->getPerMonthQuery();

        $result = User::select([
            DB::raw("{$perMonthQuery} as month"),
            DB::raw('count(id) as count')
        ])
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->pluck('count', 'month');

        $counts = [];

        foreach(range(1, 12) as $m) {
            $month = date('F', mktime(0, 0, 0, $m, 1));

            $month = trans("app.months.{$month}");

            $counts[$month] = isset($result[$m])
                ? $result[$m]
                : 0;
        }

        return $counts;
    }

    /**
     * Creates query that will be used to fetch users per
     * month, depending on type of the connection.
     *
     * @return string
     */
    private function getPerMonthQuery()
    {
        $connection = DB::connection();

        if ($connection instanceof SQLiteConnection) {
            return 'CAST(strftime(\'%m\', created_at) AS INTEGER)';
        }

        return 'MONTH(created_at)';
    }

    /**
     * {@inheritdoc}
     */
    public function getDevicesWithUser($user_id,$imei)
    {
        return Device::where('user_id', $user_id)->get();
    }
	
	public function getActiveDevicesWithUser($user_id,$imei)
    {
        return Device::where('user_id', $user_id)->where('status','Active')->get();
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
        $roleId = is_array($roleId) ?: [$roleId];

        return $this->find($userId)->roles()->sync($roleId);
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
        return DB::table('role_user')
            ->where('role_id', $fromRoleId)
            ->update(['role_id' => $toRoleId]);
    }
	
	
	public function addDevice($data){
	
		$row = DB::table('user_devices')
			->where('device_id', $data['user_id'].'#'.$data['device_id'])
			->orwhere('phone_number', $data['phone_number'])
			->first();
		
		if(count($row) > 0){
			$record["success"] = 0;
			$record["message"] = "Device Already Registered";
			return $record;
		} else {
			$token = mt_rand(111111,999999);
			$insert = array(
				'user_id' => $data["user_id"],
				'device_id' => $data['user_id'].'#'.$data['device_id'],
				'phone_number' => $data['phone_number'],
				'country_code' => $data['country_code'],
				'status' => $data["status"],
				'sms_token' => $token,
			);
			DB::table('user_devices')->insert($insert);
			
			$row = DB::table('user_devices')->where('device_id', $data['user_id'].'#'.$data['device_id'])->first();
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
	public function get_device_number($user_id){
		$devices = DB::table('user_devices')
			->where('user_id', $user_id)
			->pluck("device_id");
		
		return $devices;
	}
	
	public function get_active_devices($user_id){
		$devices = DB::table('user_devices')
			->where('user_id', $user_id)
			->where('status', "Active")
			->get();
		
		return $devices;
	}
	
	public function get_deactive_devices($user_id){
		$devices = DB::table('user_devices')
			->where('user_id', $user_id)
			->where('status', "!=","Active")
			->get();
		
		return $devices;
	}
	
	public function verify_sms($data){
		$row = DB::table('user_devices')
			->where('user_id', $data['user_id'])
			->where('phone_number', $data['phone_number'])
			->where('device_id', $data["user_id"]."#".$data['device_id'])
			->where('sms_token', $data['sms_token'])
			->first();
		$json = array();	
		if(empty($row)){
			$json["success"] = 0;
			$json["message"] = "Token does not match!";
		} else {
			
			$this->update($data['user_id'],["status" => "Active","phone" => $data['phone_number']]);
			DB::table('user_devices')
				->where('user_id', $data['user_id'])
				->where('phone_number', $data['phone_number'])
				->where('device_id', $data["user_id"]."#".$data['device_id'])
				->where('sms_token', $data['sms_token'])
				->update(['is_sms_verified' => 1]);
				
			$row = DB::table('user_devices')
			->where('user_id', $data['user_id'])
			->where('phone_number', $data['phone_number'])
			->where('device_id', $data["user_id"]."#".$data['device_id'])
			->where('sms_token', $data['sms_token'])
			->first();
				
			$json["success"] = 1;
			$json["message"] = "Verified";
			$json["data"] = $row;
		}
		
		return $json;
	}
	
	public function addLocationOfDevice($data){
		
		
	}
	
}
