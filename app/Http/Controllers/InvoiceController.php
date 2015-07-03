<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
//        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadHTML('<h1>Test</h1>');
//        return $pdf->stream();
        return view('invoice.add-group-invoice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function getGroupDetails() {
        $reg_id = trim(strip_tags($_GET['term']));
        //$term = 'KEHFIK';
        $group_data = \DB::table('groups')
                ->where('reg_id', 'like', '%' . $reg_id . '%')
                ->get(['reg_id', 'name', 'group_type']);
        //dd($data[0]->email);
        //print json_encode($data);
//        $matches = array();
        foreach ($group_data as $data) {
            $vehicle_type = $data->group_type;
            $vehicle_fee = \App\Charge::find($vehicle_type);
            $vehicles = \App\Vehicle::where('sacco_id', $data->id);
            switch ($vehicle_type) {
                case 1:
                    /*
                     * Taxi charges
                     * Each taxi pays an annual fee of amount x
                     */
                    $fee = $vehicle_fee->standard_fee * $vehicles->count();
                    break;
                case 2:
                    /*
                     * Matatu charges
                     * Each matatu pays annual fee of amount y
                     */
                    $fee = $vehicle_fee * $vehicles->count();
                    break;
                case 3:
                    /*
                     * Company vehicles
                     * Each vehicle pays an annual fee of amount z
                     */
                    $fee = $vehicle_fee * $vehicles->count();
                    break;
                case 4:
                    /*
                     * Tour firms
                     * Tour vans(14 seater) pay annual fee of amount k and amount h for every extra seat
                     */
                    $fee = 0;
                    foreach ($vehicles as $vehicle) {
                        if ($vehicle->no_of_seat > 14) {
                            $fee += ($vehicle_fee * $vehicles->count()) + ($vehicle->no_of_seat - 14) * ($vehicle_fee->extra_fee);
                        }
                    }
                    break;
                default :
                    return redirect('invoice.index')
                                    ->with('global', '<div class="alert alert-danger">The system could not generate invoice due to invalid data provided. Please try again and contact the system administrator if this message persists</div>');
            }
            $det['reg_id'] = $data->reg_id;
            $det['name'] = $data->name;
            $det['fee'] = $fee;
            $det['group_type'] = $data->group_type;
            $det['no_vehicle'] = $vehicles->count();
            $det['value'] = $data->reg_id;
            $det['label'] = "{$data->reg_id}, {$data->name}";
            $matches[] = $det;
        }
        print json_encode($matches);
    }

}
