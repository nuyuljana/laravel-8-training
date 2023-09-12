<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::get();
        //dd($vehicles); //dump & die

        return view('vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        $edit = false;
        return view('vehicle.form', compact('edit'));
    }

    public function save(Request $request)
    {
        //dd($request);
        $input = [];
        $input['brand'] = $request->brand;
        $input['model'] = $request->model;
        $input['type'] = $request->type;
        $input['year'] = $request->year;
        $input['status'] = 1;
        $input['created_at'] = now();

        //dd($input);

        Vehicle::insert($input);

        //get ID from the new inserted data
        //$vehicleId = Vehicle::insertGetId($input);

        return redirect(route('vehicle.index'))-> withSuccess('Vehicle Data Successfully Created!');
    }

    public function edit($id)
    {
        $edit = true;
        $vehicle = Vehicle::where('id', $id)->first();
        //dd($vehicle);

        return view('vehicle.form', compact('vehicle','edit'));
    }

    public function update(Request $request, $id)
    {
        //dd($request, $id, 'The vehicle ID is ' . $id);
        $input = [];
        $input['brand'] = $request->brand;
        $input['model'] = $request->model;
        $input['type'] = $request->type;
        $input['year'] = $request->year;
        $input['updated_at'] = now();

        Vehicle::where('id', $id)->update($input);

        return redirect(route('vehicle.index'))-> withSuccess('Vehicle Data Successfully Updated!');
    }

    public function delete($id)
    {
        Vehicle::where('id', $id)->delete();

        return redirect(route('vehicle.index'))-> withSuccess('Vehicle Data Successfully Deleted!');
    }

    public function softDelete($id)
    {
        $input = [];
        $input['status'] = 0;
        $input['deleted_at'] = now();

        Vehicle::where('id', $id)->update($input);

        return redirect(route('vehicle.index'))-> withSuccess('Vehicle Data Successfully Deleted!');
    }

}
