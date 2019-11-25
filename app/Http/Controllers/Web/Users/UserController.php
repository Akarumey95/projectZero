<?php

namespace App\Http\Controllers\Web\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request){

        User::create([
            'name' => $request['userName'],
            'email' => $request['userEmail'],
            'password' => Hash::make($request['userPassword']),
            'role_id' => $request['userRole'],
        ]);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request){

        $user = User::where('id', $request['userId'])->first();

        $toUpdate = [
            'name' => $request['userName'],
            'email' => $request['userEmail'],
            'role_id' => $request['userRole'],
        ];

        if(!empty($request['userPassword']) &&
            Hash::make($request['userPassword']) != $user->password){
            $toUpdate['password'] = Hash::make($request['userPassword']);
        }

        User::where('id', $request['userId'])->update($toUpdate);

        return redirect()->back();
    }
}
