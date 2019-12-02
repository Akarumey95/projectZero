<?php

namespace App\Http\Controllers\Web\Cars;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();

        return view('admin.cars.car',[
            'cars' => $cars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cars.form', [
            'method' => 'post',
            'action' => '/admin/car',
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
        Car::create([
            'name' => $request['carName'],
            'type' => $request['carType'],
            'body_number' => $request['carBodyNumber'],
        ]);

        return redirect('/admin/car');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect('/admin/car');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::where('id', $id)->first();

        return view('admin.cars.form',[
            'method' => 'put',
            'action' => '/admin/car/' . $id,
            'car' => $car,
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
        Car::where('id', $id)->update([
            'name' => $request['carName'],
            'type' => $request['carType'],
            'body_number' => $request['carBodyNumber'],
        ]);

        return redirect('/admin/car');
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
