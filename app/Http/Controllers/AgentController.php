<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AgentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $agents = \App\Agent::with('region')->get();
        return view('agent.index', array('agent' => $agents));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $regions = \App\Region::all();
        return view('agent.add-agent', array('regions' => $regions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store() {
        $validator = \Validator::make(\Request::all(), array(
                    'name' => 'required|max:255|unique:groups',
                    'region_id' => 'required',
                    'phone_no' => 'sometimes|digits_between:10,15',
                        )
        );
        //dd(\Request::all());
        if ($validator->fails()) {
            return redirect('/agent/add-agent')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $agents = \App\Agent::create(\Request::all());
            if ($agents) {
                return redirect('/agent')
                                ->with('global', '<div class="alert alert-success">Agent details successfullly saved in the database</div>');
            } else {
                return redirect('/agent')
                                ->with('global', '<div class="alert alert-warning">Your input could not be saved. Please contact administrator!</div>');
            }
        }
    }

    public function delete($agent_id) {
        $id = \Hashids::decode($agent_id)[0];
        $delete = \App\Agent::find($id)->delete();

        if ($delete) {
            return redirect('/agent')
                            ->with('global', '<div class="alert alert-success">Agent successfullly deleted</div>');
        } else {
            return redirect('/agent')
                            ->with('global', '<div class="alert alert-warning">Agent could not be deleted</div>');
        }
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
        $agent = \App\Agent::with('region')->find(\Hashids::decode($id)[0]);
        $region = \App\Region::all();
        return view('agent.edit-agent', array('agent' => $agent, 'regions' => $region));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update() {
        $update = \DB::table('agents')
                ->where('id', \Request::get('id'))
                ->update(array(
            'name' => \Request::get('name'),
            'phone_no' => \Request::get('phone_no'),
            'region_id' => \Request::get('region_id'),
            'user_id' => \Auth::user()->id,
            'postal_address' => \Request::get('postal_address')
        ));
        if ($update) {
            return redirect('/agent')
                            ->with('global', '<div class="alert alert-success">Agent successfullly updated</div>');
        } else {
            return redirect('/agent')
                            ->with('global', '<div class="alert alert-warning">Agent could not be updated</div>');
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

}
