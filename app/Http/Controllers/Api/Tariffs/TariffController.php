<?php

namespace App\Http\Controllers\Api\Tariffs;

use App\Helpers\ToJson;
use App\Http\Controllers\Controller;
use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = Tariff::all();

        return ToJson::json($response,'ok','201','All Tariffs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $response = Tariff::create($request->all());

        return ToJson::json($response,'ok','201','Tariff Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $response = Tariff::where('id', $id)->first();

        return ToJson::json($response,'ok','201','Tariff id: ' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $response = Tariff::where('id', $id)->update($request->all());

        return ToJson::json($response,'ok','201','Updated tariff id: ' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Tariff::where('id', $id)->delete();

        return ToJson::json($response,'ok','201','Deleted tariff id: ' . $id);
    }
}
