<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $date = date('2015-1-1');
        $f_date = date_create('01-01-2015');
        $det['set_date'] = date_format($f_date, 'd-m-Y');
        $det['total_groups'] = \App\Group::all()->count();
        $det['company_groups'] = \App\Group::where('type_id', 5)->where('created_at', '>=', $date)->count();
        $det['taxi_groups'] = \App\Group::where('type_id', 4)->where('created_at', '>=', $date)->count();
        $det['bus_groups'] = \App\Group::where('type_id', 3)->where('created_at', '>=', $date)->count();
        $det['sacco_groups'] = \App\Group::where('type_id', 2)->where('created_at', '>=', $date)->count();
        $det['tour_groups'] = \App\Group::where('type_id', 6)->where('created_at', '>=', $date)->count();
        // Registered groups
        $det['total_vehicles'] = \App\Vehicle::all()->count();
        $det['company_vehicles'] = \App\Vehicle::where('type_id', 5)->where('created_at', '>=', $date)->count();
        $det['taxi_vehicles'] = \App\Vehicle::where('type_id', 4)->where('created_at', '>=', $date)->count();
        $det['bus_vehicles'] = \App\Vehicle::where('type_id', 3)->where('created_at', '>=', $date)->count();
        $det['sacco_vehicles'] = \App\Vehicle::where('type_id', 2)->where('created_at', '>=', $date)->count();
        $det['tour_vehicles'] = \App\Vehicle::where('type_id', 6)->where('created_at', '>=', $date)->count();
        $det['taxis'] = \App\Vehicle::where('type_id', 1)->where('created_at', '>=', $date)->count();
        return view('reports.index', array('data' => $det));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show() {
        $date = \Request::get('set_date');
        
        $det['set_date'] = $date;
        // Registered groups
        $det['total_groups'] = \App\Group::all()->count();
        $det['company_groups'] = \App\Group::where('type_id', 5)->where('created_at', '>=', $date)->count();
        $det['taxi_groups'] = \App\Group::where('type_id', 4)->where('created_at', '>=', $date)->count();
        $det['bus_groups'] = \App\Group::where('type_id', 3)->where('created_at', '>=', $date)->count();
        $det['sacco_groups'] = \App\Group::where('type_id', 2)->where('created_at', '>=', $date)->count();
        $det['tour_groups'] = \App\Group::where('type_id', 6)->where('created_at', '>=', $date)->count();
        // Registered groups
        $det['total_vehicles'] = \App\Vehicle::all()->count();
        $det['company_vehicles'] = \App\Vehicle::where('type_id', 5)->where('created_at', '>=', $date)->count();
        $det['taxi_vehicles'] = \App\Vehicle::where('type_id', 4)->where('created_at', '>=', $date)->count();
        $det['bus_vehicles'] = \App\Vehicle::where('type_id', 3)->where('created_at', '>=', $date)->count();
        $det['sacco_vehicles'] = \App\Vehicle::where('type_id', 2)->where('created_at', '>=', $date)->count();
        $det['tour_vehicles'] = \App\Vehicle::where('type_id', 6)->where('created_at', '>=', $date)->count();
        $det['taxis'] = \App\Vehicle::where('type_id', 1)->where('created_at', '>=', $date)->count();

        //dd($det['total_groups']);
        return view('reports.index', array('data' => $det));
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
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
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

    public function details() {
        $tarehe = trim(strip_tags($_GET['term']));
        $date = date($tarehe);
        //dd($date);
        // Registered groups
        $det['total_groups'] = \App\Group::all()->count();
        $det['company_groups'] = \App\Group::where('type_id', 5)->where('created_at', '>=', $date)->count();
        $det['taxi_groups'] = \App\Group::where('type_id', 4)->where('created_at', '>=', $date)->count();
        $det['bus_groups'] = \App\Group::where('type_id', 3)->where('created_at', '>=', $date)->count();
        $det['sacco_groups'] = \App\Group::where('type_id', 2)->where('created_at', '>=', $date)->count();
        $det['tour_groups'] = \App\Group::where('type_id', 6)->where('created_at', '>=', $date)->count();
        // Registered groups
        $det['total_vehicles'] = \App\Vehicle::all()->count();
        ;
        $det['company_vehicles'] = \App\Vehicle::where('type_id', 5)->where('created_at', '>=', $date)->count();
        $det['taxi_vehicles'] = \App\Vehicle::where('type_id', 4)->where('created_at', '>=', $date)->count();
        $det['bus_vehicles'] = \App\Vehicle::where('type_id', 3)->where('created_at', '>=', $date)->count();
        $det['sacco_vehicles'] = \App\Vehicle::where('type_id', 2)->where('created_at', '>=', $date)->count();
        $det['tour_vehicles'] = \App\Vehicle::where('type_id', 6)->where('created_at', '>=', $date)->count();
        $det['taxis'] = \App\Vehicle::where('type_id', 1)->where('created_at', '>=', $date)->count();

        $matches[] = $det;
        print json_encode($matches);
    }

}
