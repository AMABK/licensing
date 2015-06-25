<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('vehicle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $saccos = \App\Sacco::all();
        return view('vehicle.add-vehicle',array('sacco' => $saccos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = \Validator::make(\Request::all(), array(
                    'reg_no' => 'required|max:10|unique:vehicles',
                    'category' => 'required|max:255',
                    'sacco_id' => 'sometimes|integer',
                    'vehicle_make' => 'required',
                    'no_of_seat' => 'required|integer'
                        )
        );
        //dd(\Request::all());
        if ($validator->fails()) {
            return redirect('/vehicle/add-vehicle')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $vehicle= \App\Vehicle::create(\Request::all());
            if ($vehicle) {
                return redirect('vehicle/view-vehicle/' . \Hashids::encode(\Request::input('reg_id')))
                                ->with('global', '<div class="alert alert-success">Vehicle successfullly saved in the database</div>');
            } else {
                return redirect('vehicle/add-vehicle')
                                ->with('global', '<div class="alert alert-danger">Whoooops, your input could not be saved. Please contact administrator!</div>');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $vehicles = \App\Vehicle::all();
        return view('vehicle.view-vehicles', array('vehicle' => $vehicles));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
