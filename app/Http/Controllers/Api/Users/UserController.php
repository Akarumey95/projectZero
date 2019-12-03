<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\UserWorker;
use App\Helpers\ToJson;
use App\Models\Driver;
use App\Models\Passenger;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @api {get} /user User info
     * @apiName  User
     * @apiVersion 0.0.1
     * @apiGroup User
     * @apiPermission Authorization
     * @apiHeader  Authorization token
     * @apiSampleRequest  /user
     */
    public function index(Request $request)
    {


        $user = $request->user();
        $data['user'] = $user->only('id', 'email');
        $data['role'] = $user->role()->name;
        if($user::checkRole('Driver')){
            $data['info'] = $user->driverData();
        }elseif($user::checkRole('Passenger')){
            $data['info'] = $user->passengerData();
        }

        return ToJson::json($data,'ok','201','User info');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        /*$response = User::create($request->all());
        return ToJson::json($response,'ok','201','User Create');*/
    }


    /**
     *
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $validation = UserWorker::validateRequest(false, $request->user()->role()->name, $request);
        if(!$validation['status']) return ToJson::json([],'false','400',$validation['message']);

        $id = $request->user()->id;
        $data = $request->all();

        if($request->has('password')) $data['password'] = UserWorker::hashPassword($request);

        $user = User::where('id', $id)->update($data);

        $response['user'] = $user;

        if($user::checkRole('Driver')){

            if ($request->hasFile('avatar')) $data['avatar'] = UserWorker::driverAvatar($request, $user);

            if($request->hasFile('driver_license_photo'))
                $data['driver_license_photo'] = UserWorker::driverLicense($request, $user);

            if($request->hasFile('taxi_license_photo'))
                $data['taxi_license_photo'] = UserWorker::taxiLicense($request, $user);

            $driver = Driver::where('user_id', $id);
            if($driver){
                $driverData = $driver->updata($data);
            }else{
                $data['user_id'] = $id;
                $driverData =Passenger::create($data);
            }
            $response['info'] = $driverData;

        }elseif ($user::checkRole('Passenger')){
            if($request->has('card_expiry', 'card_number', 'card_cvc'))
                $data['card'] = UserWorker::passengerCard($request);

            if($request->hasFile('photo'))
                $data['photo'] = UserWorker::passengerPhoto($request, $user);

            $passenger = Passenger::where('user_id', $id);
            if($passenger){
                $passengerData = $passenger->updata($data);
            }else{
                $data['user_id'] = $id;
                $passengerData =Passenger::create($data);
            }

            $response['info'] = $passengerData;
        }

        return ToJson::json($response,'ok','201','Updated role id: ' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
