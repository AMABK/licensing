<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SaccoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('sacco.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('sacco.add-sacco');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $validator = \Validator::make(\Request::all(), array(
                    'reg_id' => 'required|max:10|unique:saccos',
                    'name' => 'required|max:255',
                    'phone_no' => 'sometimes|digits_between:10,15',
                    'email' => 'sometimes|email',
                    'no_vehicle' => 'required|integer',
                    'yr_of_license' => 'required|digits:4',
                    'expiry_date' => 'required|date',
                    'fee_paid' => 'required|integer'
                        )
        );
        //dd(\Request::all());
        if ($validator->fails()) {
            return redirect('/sacco/add-sacco')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $sacco = \App\Sacco::create(\Request::all());
            if ($sacco) {
                return redirect('sacco/view-sacco/' . \Hashids::encode(\Request::input('reg_id')))
                                ->with('global', '<div class="alert alert-success">Sacco successfullly saved in the database</div>');
            } else {
                return redirect('sacco/add-sacco')
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
    public function show() {
        $saccos = \App\Sacco::all();
        return view('sacco.view-saccos', array('sacco' => $saccos));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $sacco = \App\Sacco::find(\Hashids::decode($id));
        return view('sacco.edit-sacco', array('saccos' => $sacco));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update() {
        if (isset($_POST['delete'])) {
            return redirect('sacco/view-saccos')
                            ->with('global', '<div class="alert alert-warning">Whoooops, this functionality is not yet available!</div>');
        }
        $validator = \Validator::make(\Request::all(), array(
                    'name' => 'required|max:255',
                    'phone_no' => 'sometimes|digits_between:10,15',
                    'email' => 'sometimes|email',
                    'no_vehicle' => 'required|integer',
                    'yr_of_license' => 'required|digits:4',
                    'expiry_date' => 'required|date',
                    'fee_paid' => 'required|integer'
                        )
        );
        if ($validator->fails()) {
            return redirect('/sacco/edit-sacco/' . \Hashids::encode(\Request::input('id')))
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $sacco = \DB::table('saccos')
                    ->where('id', \Request::input('id'))
                    ->update(array(
                'name' => \Request::input('name'),
                'phone_no' => \Request::input('phone_no'),
                'email' => \Request::input('email'),
                'no_vehicle' => \Request::input('no_vehicle'),
                'yr_of_license' => \Request::input('yr_of_license'),
                'expiry_date' => \Request::input('expiry_date'),
                'fee_paid' => \Request::input('fee_paid'),
                'user_id' => \Auth::user()->id
                    )
            );
            if ($sacco) {
                return redirect('sacco/view-saccos')
                                ->with('global', '<div class="alert alert-success">Sacco successfullly update in the database</div>');
            } else {
                return redirect('sacco/view-saccos')
                                ->with('global', '<div class="alert alert-warning">Whoooops, no changes have been made to the sacco details!</div>');
            }
        }
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

    /*
     * Show all vehicles under a particular Sacco
     */

    public function showSacco($sid) {
        $id = \Hashids::decode($sid);
        $sacco = \DB::table('saccos')
                ->join('vehicles', function ($join) {
                    $join->on('saccos.id', '=', 'vehicles.sacco_id');
                })
                ->where('saccos.id', '=', $id)
                ->get();
        if ($sacco == null) {
            return redirect()->back()
                            ->with('global', '<div class="alert alert-warning">The sacco you selected does not have any registered vehicles</div>');
        }
        return view('sacco.view-sacco', array('sacco' => $sacco));
    }

    public function getSaccos() {
        $sacco = \App\Sacco::all();
        //dd($saccos);
        if ($_GET['type'] == 'reg_id') {
            $reg_id = $_GET['name_startsWith'];
            //$data = mysql_query("SELECT name FROM country where name LIKE '".strtoupper($_GET['name_startsWith'])."%'");	
            $data = \DB::table('saccos')
                ->where('reg_id', 'like', '%'.$reg_id.'%')
                ->get();
            // $data = array();
//	while ($row = mysql_fetch_array($result)) {
//		array_push($data, $row['name']);	
//	}	
            echo json_encode($data);
        }
    }
    public function addNewVehicle($id) {
            $sacco = \DB::table('saccos')
                            ->where('id', \Hashids::decode($id)[0])->first();
            return view('sacco.add-new-vehicle',array('sacco' => $sacco));
    }

}
