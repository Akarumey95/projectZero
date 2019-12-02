<?php

namespace App\Http\Controllers\Web\Roles;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createRole(Request $request){

        Role::create($request->all());

        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole(Request $request, $id){
        Role::where('id', $id)->update([
            'name' => $request['roleName'],
        ]);

        return redirect()->back();
    }
}
