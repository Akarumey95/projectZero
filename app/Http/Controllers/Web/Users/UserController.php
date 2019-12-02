<?php

namespace App\Http\Controllers\Web\Users;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.users.user',[
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.form', [
            'method' => 'post',
            'action' => '/admin/user',
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request['userName'],
            'email' => $request['userEmail'],
            'password' => Hash::make($request['userPassword']),
            'role_id' => $request['userRole'],
        ]);

        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return redirect('/admin/user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();

        return view('admin.users.form',[
            'method' => 'put',
            'action' => '/admin/user/' . $id,
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $toUpdate = [
            'name' => $request['userName'],
            'email' => $request['userEmail'],
            'role_id' => $request['userRole'],
        ];

        if(!empty($request['userPassword']) &&
            Hash::make($request['userPassword']) != $user->password){
            $toUpdate['password'] = Hash::make($request['userPassword']);
        }

        User::where('id', $id)->update($toUpdate);

        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
