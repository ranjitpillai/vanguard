<?php

namespace Vanguard;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Vanguard\Presenters\DevicePresenter;
use Vanguard\Services\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;
use Vanguard\Services\Auth\TwoFactor\Contracts\Authenticatable as TwoFactorAuthenticatableContract;
use Vanguard\Services\Logging\UserActivity\Activity;
use Vanguard\Support\Authorization\AuthorizationUserTrait;
use Vanguard\Support\Enum\UserStatus;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Device extends Model
{
	use PresentableTrait;
	
	protected $presenter = 'DevicePresenter';
    
    protected $table = 'user_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'device_id', 'IMEI', 'phone_number', 'country_code', 'status', 'sms_token', 'os_api_level',
        'device', 'model', 'manufacturer', 'brand', 'display', 'os_version'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
   /* 
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = trim($value) ?: null;
    }

    public function gravatar()
    {
        $hash = hash('md5', strtolower(trim($this->attributes['email'])));

        return sprintf("//www.gravatar.com/avatar/%s", $hash);
    }

    public function isUnconfirmed()
    {
        return $this->status == UserStatus::UNCONFIRMED;
    }

    public function isActive()
    {
        return $this->status == UserStatus::ACTIVE;
    }

    public function isBanned()
    {
        return $this->status == UserStatus::BANNED;
    }

    public function socialNetworks()
    {
        return $this->hasOne(UserSocialNetworks::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id');
    } */
}
