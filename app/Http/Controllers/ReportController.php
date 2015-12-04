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
        $det['from_date'] = date('2015-1-1');
        $det['to_date'] = date('Y-m-d');

        //$f_date = date_create('01-01-2015');
        //$det['from_date'] = date_format($f_date, 'd-m-Y');
        $det['total_groups'] = \App\Group::
                where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['company_groups'] = \App\Group::where('type_id', 5)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['taxi_groups'] = \App\Group::where('type_id', 4)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['bus_groups'] = \App\Group::where('type_id', 3)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['sacco_groups'] = \App\Group::where('type_id', 2)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['tour_groups'] = \App\Group::where('type_id', 6)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        // Registered groups
        $det['total_vehicles'] = \App\Vehicle::
                where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['company_vehicles'] = \App\Vehicle::where('type_id', 5)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['taxi_vehicles'] = \App\Vehicle::where('type_id', 4)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['bus_vehicles'] = \App\Vehicle::where('type_id', 3)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['sacco_vehicles'] = \App\Vehicle::where('type_id', 2)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['tour_vehicles'] = \App\Vehicle::where('type_id', 6)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['taxis'] = \App\Vehicle::where('type_id', 1)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        return view('reports.index', array('data' => $det));
    }

    public function reports() {
        $payer_id = 0;
        //Collections per region per tariff
        $price[1] = \DB::select('SELECT SUM(discount) as discount,SUM(total_fee) as total FROM invoices WHERE invoice_type ="Individual Invoice" AND payer_id = 1 AND region_id = 1');
        //Total collections per tariff
        $price[2] = \DB::select('SELECT SUM(discount) as discount,SUM(total_fee) as total FROM invoices WHERE invoice_type ="Individual Invoice" AND payer_id = 1');
        //Consolidated collections per Licensing Agent
        $price[3] = \DB::select('SELECT SUM(discount) as discount,SUM(total_fee) as total FROM invoices WHERE agent_id = 1');
        //Consolidated figure for all tariffs.
        $price[4] = \DB::select('SELECT SUM(discount) as discount,SUM(total_fee) as total FROM invoices ');
        //dd($price[0]->discount);
        //dd($price);
        return view('reports.reports', array('price' => $price));
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
        $det['from_date'] = \Request::get('from_date');
        $det['to_date'] = \Request::get('to_date');
        if ($det['from_date'] > $det['to_date']) {
            return redirect('/reports')
            ->with('global', '<div class="alert alert-warning">Invalid dates selected. From Date can not be later than To Date</div>');
        }
        // Registered groups
        $det['total_groups'] = \App\Group::
                where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['company_groups'] = \App\Group::where('type_id', 5)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['taxi_groups'] = \App\Group::where('type_id', 4)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['bus_groups'] = \App\Group::where('type_id', 3)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['sacco_groups'] = \App\Group::where('type_id', 2)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['tour_groups'] = \App\Group::where('type_id', 6)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        // Registered groups
        $det['total_vehicles'] = \App\Vehicle::
                where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['company_vehicles'] = \App\Vehicle::where('type_id', 5)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['taxi_vehicles'] = \App\Vehicle::where('type_id', 4)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['bus_vehicles'] = \App\Vehicle::where('type_id', 3)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['sacco_vehicles'] = \App\Vehicle::where('type_id', 2)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['tour_vehicles'] = \App\Vehicle::where('type_id', 6)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
        $det['taxis'] = \App\Vehicle::where('type_id', 1)
                ->where('created_at', '>=', $det['from_date'])
                ->where('created_at', '<=', $det['to_date'])
                ->count();
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

    public function financeReports() {
        
    }

}
