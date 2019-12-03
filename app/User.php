<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;


/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $roleName
     * @return bool
     */
    public static function checkRole($roleName){
        return self::find(auth()->id())->role()->name == $roleName ? true : false;
    }

    /**
     * Get the role record associated with the user.
     */
    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id')->first();
    }

    /**
     * @return HasOne|string
     */
    public function driverData()
    {
        if(self::checkRole('Driver')){
            return $this->hasOne('App\Models\Driver', 'user_id', 'id')->first();
        }else{
            return 'User not driver';
        }
    }

    /**
     * @return HasOne|string
     */
    public function passengerData()
    {
        if(self::checkRole('Passenger')){
            return $this->hasOne('App\Models\Passenger', 'user_id', 'id')->first();
        }else{
            return 'User not passenger';
        }
    }
}
