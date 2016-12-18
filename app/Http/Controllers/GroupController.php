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
        $count['groups'] = \App\Group::all()->count();
        $count['taxi'] = \App\Group::where('type_id', 4)->count();
        $count['matatu'] = \App\Group::where('type_id', 2)->count();
        $count['bus'] = \App\Group::where('type_id', 3)->count();
        $count['tour'] = \App\Group::where('type_id', 6)->count();
        $count['company'] = \App\Group::where('type_id', 5)->count();

        return view('group.index', array('counts' => $count));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $groups = \App\Vehicle_type::all();
        return view('group.add-group', array('group' => $groups));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $validator = \Validator::make(\Request::all(), array(
                    'group_code' => 'sometimes|max:10|unique:groups',
                    'name' => 'required|max:255|unique:groups',
                    'type_id' => 'required|max:255',
                    'phone_no' => 'sometimes|digits_between:10,15',
                    'email' => 'sometimes|email',
                        )
        );
        //dd(\Request::all());
        if ($validator->fails()) {
            return redirect('/group/add-group')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $group = \App\Group::create(\Request::all());
            $auto_reg_id = $this->generateGroupId(\Request::get('type_id'), $group->id);
            $group->update(['reg_id' => $auto_reg_id]);
            if ($group) {
                return redirect('/group/view-groups')
                                ->with('global', '<div class="alert alert-success">Group successfullly saved in the database</div>');
            } else {
                return redirect('/group/view-groups')
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
        $groups = \App\Group::where('status', 0)->get();
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
            $check = \App\User_role::where('user_id', \Auth::user()->id)
                    ->where('role_id', 1)
                    ->count();
            $find = \App\Group::find(\Request::get('id'));

            if ($find->status == 0) {
                $group = \DB::table('groups')
                        ->where('id', \Request::input('id'))
                        ->update(array(
                    'status' => 1
                ));
                if ($group) {
                    return redirect('group/view-groups')
                                    ->with('global', '<div class="alert alert-success">Group successfully deleted by officer<div>');
                } else {
                    return redirect('group/view-groups')
                                    ->with('global', '<div class="alert alert-warning">Whoooops, this group could not be deleted!</div>');
                }
            } elseif (($check > 0) && ($find->status == 1)) {
                \App\Vehicle::where('group_id', \Request::get('id'))->delete();
                $delete = $find->delete();
                if ($delete) {
                    return redirect('group/view-groups')
                                    ->with('global', '<div class="alert alert-success">Group successfully permanently deleted<div>');
                } else {
                    return redirect('group/view-groups')
                                    ->with('global', '<div class="alert alert-warning">Whoooops, this group could not be permanently deleted!</div>');
                }
            } else {
                return redirect('group/view-groups')
                                ->with('global', '<div class="alert alert-warning">You do not have privileges to permanently delete this record</div>');
            }
        }
        $validator = \Validator::make(\Request::all(), array(
                    'name' => 'required|max:255',
                    'type_id' => 'required|max:255',
                    'id' => 'required|max:255',
                    'phone_no' => 'sometimes|digits_between:10,15',
                    'email' => 'sometimes|email',
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
                'group_code' => \Request::input('group_code'),
                'type_id' => \Request::input('type_id'),
                'physical_address' => \Request::input('physical_address'),
                'postal_address' => \Request::input('postal_address'),
                'phone_no' => \Request::input('phone_no'),
                'email' => \Request::input('email'),
                'user_id' => \Auth::user()->id
                    )
            );
            if ($group) {
                return redirect('/group/view-groups')
                                ->with('global', '<div class="alert alert-success">Group successfullly updated in the database</div>');
            } else {
                return redirect('/group/view-groups')
                                ->with('global', '<div class="alert alert-warning">Whoooops, no changes have been made to the group details!</div>');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleted() {
        $groups = \App\Group::where('status', 1)->get();
        return view('group.view-deleted-groups', array('group' => $groups));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id) {
        $restore = \DB::table('groups')
                ->where('id', \Hashids::decode($id)[0])
                ->update(array(
            'status' => 0
        ));
        if ($restore) {
            return redirect()->back()
                            ->with('global', '<div class="alert alert-success">The group successfully restored</div>');
        } else {
            return redirect()->back()
                            ->with('global', '<div class="alert alert-warning">The group could not be restored, please contact system admin</div>');
        }
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
        //dd($groups);
        if ($_GET['type'] == 'reg_id') {
            $reg_id = $_GET['name_has'];
            //$data = mysql_query("SELECT name FROM country where name LIKE '".strtoupper($_GET['name_startsWith'])."%'");	
            $data = \DB::table('groups')
                    ->where('reg_id', 'like', '%' . $reg_id . '%')
                    ->orWhere('name','like', '%' . $reg_id . '%')
                    ->get();
            // $data = array();
//	while ($row = mysql_fetch_array($result)) {
//		array_push($data, $row['name']);	
//	}	

            echo json_encode($data);
        }
    }

    public function generateGroupId($type_id, $group_id) {
        $type = \App\Vehicle_type::find($type_id);
        return $reg_no = '' . $type->code . '-' . $group_id;
    }

}
