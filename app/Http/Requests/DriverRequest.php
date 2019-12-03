<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => 'string',
            'phone' => 'string|unique:drivers,phone',
            'city' => 'string',
            'first_name' => 'string|max:50',
            'last_name' => 'string|max:50',
            'language' => 'string',
            'referral' => 'nullable|string',

            // TODO update to correct validation
            'driver_license_photo' => 'image',
            'driver_license_number' => 'string',
            'taxi_license_photo' => 'image',
            'taxi_license_number' => 'string',
            'taxi_license_expires' => 'date_format:y/m/d',
            'taxi_license_traffic_auth' => 'string',
        ];
    }
}
