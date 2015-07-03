<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('group.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('group.add-group');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $validator = \Validator::make(\Request::all(), array(
                    'reg_id' => 'required|max:10|unique:groups',
                    'name' => 'required|max:255',
                    'type' => 'required|max:255',
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
            return redirect('/group/add-group')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $group = \App\Group::create(\Request::all());
            if ($group) {
                return redirect('group/view-group/' . \Hashids::encode(\Request::input('reg_id')))
                                ->with('global', '<div class="alert alert-success">Group successfullly saved in the database</div>');
            } else {
                return redirect('group/add-group')
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
        $groups = \App\Group::all();
        return view('group.view-groups', array('group' => $groups));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $group = \App\Group::find(\Hashids::decode($id));
        return view('group.edit-group', array('groups' => $group));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update() {
        if (isset($_POST['delete'])) {
            return redirect('group/view-groups')
                            ->with('global', '<div class="alert alert-warning">Whoooops, this functionality is not yet available!</div>');
        }
        $validator = \Validator::make(\Request::all(), array(
                    'name' => 'required|max:255',
                    'type' => 'required|max:255',
                    'phone_no' => 'sometimes|digits_between:10,15',
                    'email' => 'sometimes|email',
                    'no_vehicle' => 'required|integer',
                    'yr_of_license' => 'required|digits:4',
                    'expiry_date' => 'required|date',
                    'fee_paid' => 'required|integer'
                        )
        );
        if ($validator->fails()) {
            return redirect('/group/edit-group/' . \Hashids::encode(\Request::input('id')))
                            ->withErrors($validator)
                            ->withInput()
                            ->with('global', '<div class="alert alert-warning">Whoooops, looks like there are invalid inputs!</div>' . $validator->errors());
        } else {
            $group = \DB::table('groups')
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
            if ($group) {
                return redirect('group/view-groups')
                                ->with('global', '<div class="alert alert-success">Group successfullly updated in the database</div>');
            } else {
                return redirect('group/view-groups')
                                ->with('global', '<div class="alert alert-warning">Whoooops, no changes have been made to the group details!</div>');
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
     * Show all vehicles under a particular Group
     */

    public function showGroup($sid) {
        $id = \Hashids::decode($sid);
        $group = \DB::table('groups')
                ->join('vehicles', function ($join) {
                    $join->on('groups.id', '=', 'vehicles.group_id');
                })
                ->where('groups.id', '=', $id)
                ->get();
        if ($group == null) {
            return redirect()->back()
                            ->with('global', '<div class="alert alert-warning">The group you selected does not have any registered vehicles</div>');
        }
        return view('group.view-group', array('group' => $group));
    }

    public function addNewVehicle($id) {
        $group = \DB::table('groups')
                        ->where('id', \Hashids::decode($id)[0])->first();
        return view('group.add-new-vehicle', array('group' => $group));
    }

    public function getGroups() {
        //$group = \App\Group::all();
        //dd($groups);
        if ($_GET['type'] == 'reg_id') {
            $reg_id = $_GET['name_has'];
            //$data = mysql_query("SELECT name FROM country where name LIKE '".strtoupper($_GET['name_startsWith'])."%'");	
            $data = \DB::table('groups')
                    ->where('reg_id', 'like', '%' . $reg_id . '%')
                    ->get();
            // $data = array();
//	while ($row = mysql_fetch_array($result)) {
//		array_push($data, $row['name']);	
//	}	
            echo json_encode($data);
        }
    }

}
