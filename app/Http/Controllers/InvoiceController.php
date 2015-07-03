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
        $data = \DB::table('groups')
                ->where('reg_id', 'like', '%' . $reg_id . '%')
                ->get(['reg_id', 'name', 'group_type']);
        //dd($data[0]->email);
        //print json_encode($data);
//        $matches = array();
        foreach ($data as $data) {
            
            $det['reg_id'] = $data->reg_id;
            $det['name'] = $data->name;
            $det['fee'] = $data->name;
            $det['group_type'] = $data->group_type;
            $det['no_vehicle'] = $data->group_type;
            $det['value'] = $data->reg_id;
            $det['label'] = "{$data->reg_id}, {$data->name}";
            $matches[] = $det;
        }
        print json_encode($matches);
    }

}
