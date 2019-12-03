<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Requests\PassengerRequest;
use App\Http\Requests\Required\RequiredDriverRequest;
use App\Http\Requests\Required\RequiredPassengerRequest;
use App\Http\Requests\Required\RequiredUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\TypeCar;
use Illuminate\Http\Request;

class UserWorker
{

    public static function validateRequest(bool $required, $RoleName, Request $request)
    {
        if($required === true){
            $controller = 'App\Http\Requests\Required\Required' . $RoleName . 'Request';
        }else{
            $controller = 'App\Http\Requests\\' . $RoleName . 'Request';
        }

        if(class_exists($controller)){
            (new Controller())->validate($request, (new $controller)->rules());
        }else{
            return ['status' => false, 'message' => 'Validation Controller not exist'];
        }
    }
    /**
     * @param Request $request
     * @return string
     */
    public static function hashPassword(Request $request)
    {
        return bcrypt($request->get('password'));
    }

    /**
     * @param Request $request
     * @return |null
     */
    public static function getRoleID(Request $request)
    {
        $role = Role::where('name', ucfirst($request->get('role')))->first();
        return $role === null ? null : $role->id;
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public static function passengerCard(Request $request)
    {
        return response()->json([
            'number' => $request->get('card_number'),
            'expiry' => $request->get('card_expiry'),
            'cvc' => $request->get('card_cvc'),
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     * @return string
     */
    public static function passengerPhoto(Request $request, $user)
    {
        FileWorker::delete($user->photo);
        return FileWorker::save(
            'passengers/user_' . $user->id . '/photo',
            $request->file('photo')
        );
    }

    /**
     * @param Request $request
     * @param $user
     * @return string
     */
    public static function driverAvatar(Request $request, $user)
    {
        FileWorker::delete($user->avatar);
        return FileWorker::save(
            'drivers/user_' . $user->id . '/avatar',
            $request->file('avatar')
        );
    }

    /**
     * @param Request $request
     * @param $user
     * @return false|string|null
     */
    public static function driverLicense(Request $request, $user)
    {
        FileWorker::delete($user->driver_license_photo);
        return FileWorker::save(
            'drivers/user_' . $user->id . '/driver_license',
            $request->file('driver_license_photo')
        );
    }

    /**
     * @param Request $request
     * @param $user
     * @return false|string
     */
    public static function taxiLicense(Request $request, $user)
    {
        FileWorker::delete($user->taxi_license_photo);
        return  FileWorker::save(
            'drivers/user_' . $user->id . '/taxi_license',
            $request->file('taxi_license_photo')
        );
    }

    public static function getCarTypeID(Request $request)
    {
        $type = TypeCar::where('name', $request->get('car_type'))->first();
        return $type === null ? null : $type->id;
    }
}
