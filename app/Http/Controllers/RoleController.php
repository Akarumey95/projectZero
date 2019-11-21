<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createRole(Request $request){

        Role::create([
            'name' => $request['roleName'],
        ]);

        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole(Request $request){
        Role::where('id', $request['roleId'])->update([
            'name' => $request['roleName'],
        ]);

        return redirect()->back();
    }
}
