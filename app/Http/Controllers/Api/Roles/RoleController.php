<?php

namespace App\Http\Controllers\Api\Roles;

use App\Helpers\ToJson;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    /**
     * @api {get} /roles Roles get all
     * @apiName  Roles
     * @apiVersion 0.0.1
     * @apiGroup Roles
     * @apiPermission Authorization
     * @apiHeader  Authorization token
     * @apiSampleRequest  /roles
     */
    public function index()
    {
        $roles = Role::all();
        if($roles){
            foreach ($roles as $role){
                $response[] = $role->only('id', 'name');
            }
            return ToJson::json($response,'ok','200','All Roles');
        }else{
            return ToJson::json([],'ok','200','Roles not found');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $response = Role::create($request->all());

        return ToJson::json($response,'ok','201','Role Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $response = Role::where('id', $id)->first();

        return ToJson::json($response,'ok','201','Role id: ' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $response = Role::where('id', $id)->update($request->all());

        return ToJson::json($response,'ok','201','Updated role id: ' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $response = Role::where('id', $id)->delete();

        return ToJson::json($response,'ok','201','Deleted role id: ' . $id);
    }
}
