<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class VehicleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('vehicle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $groups = \App\Group::all();
        return view('vehicle.add-vehicle', array('group' => $groups));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $validator = \Validator::make(\Request::all(), array(
                    'reg_no' => 'required|max:10|unique:vehicles',
                    'category' => 'required|max:255',
                    'group_id' => 'sometimes|integer',
                    'vehicle_make' => 'required',
                    'no_of_seat' => 'required|integer'
                        )
        );
        //dd(\Request::all());
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $group_id = \DB::table('groups')
                            ->where('reg_id', \Request::get('reg_id'))->first();
            dd(\Request::all());
            $vehicle = \App\Vehicle::create(array(
                        'reg_no' => \Request::get('reg_no'),
                        'vehicle_make' => \Request::get('vehicle_make'),
                        'category' => \Request::get('category'),
                        'group_id' => $group_id->id,
                        'tbl_no' => \Request::get('tlb_no'),
                        'no_of_seat' => \Request::get('no_of_seat'),
                        'user_id' => \Auth::user()->id
                            )
            );
            if (\Request::get('under_group') == 'Yes') {
                if ($vehicle) {
                    return redirect('group/add-new-vehicle/' . \Hashids::encode($group_id->id))
                                    ->with('global', '<div class="alert alert-success">Vehicle successfullly saved in the database</div>');
                } else {
                    return redirect('group/add-new-vehicle/' . \Hashids::encode($group_id->id))
                                    ->with('global', '<div class="alert alert-danger">Whoooops, your input could not be saved. Please contact administrator!</div>');
                }
            } else {

                if ($vehicle) {
                    return redirect('vehicle/view-vehicle/' . \Hashids::encode($vehicle->id))
                                    ->with('global', '<div class="alert alert-success">Vehicle successfullly saved in the database</div>');
                } else {
                    return redirect('vehicle/add-vehicle')
                                    ->with('global', '<div class="alert alert-danger">Whoooops, your input could not be saved. Please contact administrator!</div>');
                }
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
        $vehicles = \App\Vehicle::all();
        return view('vehicle.view-vehicles', array('vehicle' => $vehicles));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $groups = \App\Group::all();
        $vehicle = \App\Vehicle::find(\Hashids::decode($id)[0]);
        return view('vehicle.edit-vehicle', array('vehicles' => $vehicle, 'group' => $groups));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update() {
        if (isset($_POST['delete'])) {
            return redirect('vehicle/view-vehicles')
                            ->with('global', '<div class="alert alert-warning">Whoooops, this functionality is not yet available!</div>');
        }
        $validator = \Validator::make(\Request::all(), array(
                    'category' => 'required|max:255',
                    'group_id' => 'sometimes|integer',
                    'vehicle_make' => 'required',
                    'no_of_seat' => 'required|integer'
                        )
        );
        if ($validator->fails()) {
            return redirect('/vehicle/edit-vehicle/' . \Hashids::encode(\Request::input('id')[0]))
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $vehicle = \DB::table('vehicles')
                    ->where('id', \Request::input('id'))
                    ->update(array(
                'category' => \Request::input('category'),
                'vehicle_make' => \Request::input('vehicle_make'),
                'group_id' => \Request::input('group_id'),
                'tlb_no' => \Request::input('tlb_no'),
                'no_of_seat' => \Request::input('no_of_seat'),
                'user_id' => \Auth::user()->id
                    )
            );
            if ($vehicle) {
                return redirect('vehicle/view-vehicles')
                                ->with('global', '<div class="alert alert-success">Vehicle details successfullly updated in the database</div>');
            } else {
                return redirect('vehicle/view-vehicles')
                                ->with('global', '<div class="alert alert-warning">Whoooops, no changes have been made to the vehicle details!</div>');
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

    /**
     * Add vehicle to group
     */
    public function addGroup($ids) {
        if (sizeof(\Hashids::decode($ids)) == 1) {
            $groups = \App\Group::all();
            $vehicle = \App\Vehicle::find(\Hashids::decode($ids)[0]);
            return view('vehicle.view-add-group', array('group' => $groups, 'vehicle' => $vehicle));
        }
        //dd(\Hashids::decode($ids)[1]);
        $check = \App\Vehicle::find(\Hashids::decode($ids)[1]);
        if ($check->group_id != null) {
            return redirect('/vehicle/view-vehicles')
                            ->with('global', '<div class="alert alert-warning">Vehicle already belongs to a group!.</div>');
        }

        $add = \DB::table('vehicles')
                ->where('id', \Hashids::decode($ids)[1])
                ->where('group_id', null)
                ->update(array(
            'group_id' => \Hashids::decode($ids)[0],
            'category' => 'Group Vehicle',
            'user_id' => \Auth::user()->id
                )
        );
        if ($add) {
            return redirect('/vehicle/view-vehicles')
                            ->with('global', '<div class="alert alert-success">Vehicle successfully added to the circle</div>');
        } else {
            return redirect('/vehicle/view-vehicles')
                            ->with('global', '<div class="alert alert-warning">Vehicle could not be added to the group, please contact admin.</div>');
        }
    }

    public function removeGroup($ids) {
        $id = \Hashids::decode($ids);
        $check = \DB::table('vehicles')
                ->where('group_id', '=', $id[0])
                ->count();
        if ($check < 1) {
            return redirect('/group')
                            ->with('global', '<div class="alert alert-warning">There are no vehicle registered in the group</div>');
        }
        $remove = \DB::table('vehicles')
                ->where('id', $id[1])
                ->where('group_id', $id[0])
                ->update(array(
            'group_id' => null,
            'category' => 'Other',
            'user_id' => \Auth::user()->id
                )
        );
        if ($remove) {
            return redirect('/vehicle/view-vehicles')
                            ->with('global', '<div class="alert alert-success">Vehicle successfullly removed from group</div>');
        } else {
            return redirect('/vehicle/view-vehicles')
                            ->with('global', '<div class="alert alert-warning">Vehicle could not be removed from group. Please contact admin!</div>');
        }
    }

}
