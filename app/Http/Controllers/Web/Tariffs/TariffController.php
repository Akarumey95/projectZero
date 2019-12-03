<?php

namespace App\Http\Controllers\Web\Tariffs;

use App\Http\Controllers\Controller;
use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tariffs = Tariff::all();

        return view('admin.tariffs.tariff',[
            'tariffs' => $tariffs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tariffs.form', [
            'method' => 'post',
            'action' => '/admin/tariff',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tariff::create([
            'name' => $request['tariffName'],
            'rate' => $request['tariffRate'],
        ]);

        return redirect('/admin/tariff');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect('/admin/tariff');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tariff = Tariff::where('id', $id)->first();

        return view('admin.tariffs.form',[
            'method' => 'put',
            'action' => '/admin/tariff/' . $id,
            'tariff' => $tariff,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tariff::where('id', $id)->update([
            'name' => $request['tariffName'],
            'rate' => $request['tariffRate'],
        ]);

        return redirect('/admin/tariff');
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
