<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminPage()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin',[
            'users' => $users,
            'roles' => $roles,
        ]);
    }

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
