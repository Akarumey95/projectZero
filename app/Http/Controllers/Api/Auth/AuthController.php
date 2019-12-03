<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\UserWorker;
use App\Helpers\ToJson;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @api {post} /register User
     * @apiName  Registration User
     * @apiVersion 0.0.1
     * @apiGroup Registration
     * @apiParam {String} email Email
     * @apiParam {String} password Password
     * @apiParam {String} password_confirmation Password confirmation
     * @apiParam {String} role Role Name
     * @apiPermission none
     * @apiSampleRequest  /register
     */
    public function register(Request $request)
    {
        $validation = UserWorker::validateRequest(true, 'User', $request);
        if(!$validation['status']) return ToJson::json([],'false','400',$validation['message']);

        $data = $request->all();
        $data['password'] = UserWorker::hashPassword($request);

        $data['role_id'] = UserWorker::getRoleID($request);
        if($data['role_id'] === null) return ToJson::json([],'false','404','Role not found');

        $user = User::create($data);

        $accessToken = $user->createToken('authToken')->accessToken;

        return ToJson::tokenResponse($accessToken,'ok','201','User was created');
    }

    /**
     * @api {post} /register/Passenger Passenger
     * @apiName  Registration Passenger
     * @apiVersion 0.0.1
     * @apiGroup Registration
     * @apiParam {String} first_name First Name
     * @apiParam {String} last_name Last Name
     * @apiParam {String} email Email
     * @apiParam {String} phone Phone
     * @apiParam {String} password Password
     * @apiParam {String} password_confirmation Password confirmation
     * @apiParam {String} role Role Name
     * @apiParam {String} card_number card Number
     * @apiParam {String} card_expiry card Expiry
     * @apiParam {String} card_cvc card CVC
     * @apiPermission none
     * @apiSampleRequest  /register/passenger
     */
    public function registerPassenger(Request $request)
    {
        $validation = UserWorker::validateRequest(true, 'Passenger', $request);
        if(!$validation['status']) return ToJson::json([],'false','400',$validation['message']);

        $data = $request->all();
        $data['password'] = UserWorker::hashPassword($request);
        $data['card'] = UserWorker::passengerCard($request);

        $role_id = Role::where('name', ucfirst($request->get('role')))->first()->id;
        if(!$role_id) return ToJson::json([],'false','404','Role not found');
        $data['role_id'] = $role_id;

        $user = User::create($data);

        if($request->hasFile('photo')){
            $data['photo'] = UserWorker::passengerPhoto($request, $user);
            $data['user_id'] = $user->id;
            $passengerData = Passenger::create($data);
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return ToJson::tokenResponse($accessToken,'ok','201','User was created');
    }

    /**
     * @api {post} /register/driver Driver
     * @apiName  Registration Driver
     * @apiVersion 0.0.1
     * @apiGroup Registration
     * @apiParam {String} first_name First Name
     * @apiParam {String} last_name Last Name
     * @apiParam {String} email Email
     * @apiParam {String} phone Phone
     * @apiParam {String} password Password
     * @apiParam {String} password_confirmation Password confirmation
     * @apiParam {String} city City
     * @apiParam {String} language Language
     * @apiParam {String} role Role Name
     * @apiPermission none
     * @apiSampleRequest  /register/driver
     */
    public function registerDriver(Request $request)
    {
        $validation = UserWorker::validateRequest(true, 'Driver', $request);
        if(!$validation['status']) return ToJson::json([],'false','400',$validation['message']);

        $data = $request->all();

        $data['password'] = UserWorker::hashPassword($request);
        $role_id = Role::where('name', ucfirst($request->get('role')))->first()->id;
        if(!$role_id) return ToJson::json([],'false','404','Role not found');

        $data['role_id'] = $role_id;

        $user = User::create($data);


        if ($request->hasFile('avatar')) $data['avatar'] = UserWorker::driverAvatar($request, $user);

        if($request->hasFile('driver_license_photo'))
            $data['driver_license_photo'] = UserWorker::driverLicense($request, $user);

        if($request->hasFile('taxi_license_photo'))
            $data['taxi_license_photo'] = UserWorker::taxiLicense($request, $user);

        $data['user_id'] = $user->id;

        $driverData = Driver::create($data);

        $accessToken = $user->createToken('authToken')->accessToken;

        return ToJson::tokenResponse($accessToken,'ok','201','User was created');
    }

    /**
     * @api {post} /login Login
     * @apiName  Login
     * @apiVersion 0.0.1
     * @apiGroup Auth
     * @apiParam {String} email Email
     * @apiParam {String} password Password
     * @apiPermission none
     * @apiSampleRequest  /login
     */
    public function login(Request $request){
        $validation = UserWorker::validateRequest(false, 'User', $request);
        if(!$validation['status']) return ToJson::json([],'false','400',$validation['message']);

        if(!auth()->attempt($request->all())){
            return response(['message' => 'Invalid credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return ToJson::tokenResponse($accessToken);
    }
}
