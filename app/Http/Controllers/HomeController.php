<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //Verify login date auto lock
//        if (1440882000 < strtotime(date("d-m-Y"))) {
//            \Auth::user();
//            \Auth::logout();
//            
//            return redirect()->guest('/')
//                            ->with('global', '<div class="alert alert-danger" align="center">This product needs activation by the owner. Please contact arnold.mate@optimusctnologies.co.ke or +254 728 026 899 for assistance</div>');
//        }
        $count['groups'] = \App\Group::all()->count();
        $count['taxi'] = \App\Group::where('type_id', 4)->count();
        $count['matatu'] = \App\Group::where('type_id', 2)->count();
        $count['bus'] = \App\Group::where('type_id', 3)->count();
        $count['tour'] = \App\Group::where('type_id', 6)->count();
        $count['company'] = \App\Group::where('type_id', 5)->count();

        return view('home', array('counts' => $count));
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

}
