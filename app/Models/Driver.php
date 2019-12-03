<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'phone', 'city', 'first_name', 'last_name', 'language', 'referral_code', 'car',
        'social_security','avatar', 'email_verified_at',
        'driver_license_number', 'driver_license_photo',
        'taxi_license_number', 'taxi_license_photo', 'taxi_license_expires', 'taxi_license_traffic_auth',
        'company_certificate', 'invoice_form', 'company_name', 'address', 'organization_number',
        'tax_number', 'account_holder', 'bank_account_number', 'bic_swift',
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
