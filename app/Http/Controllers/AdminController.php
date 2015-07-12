<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $designation = \App\Designation::all();
        return view('admin.add-user',array('designations' => $designation));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    protected function store() {
        /*
         * Activation code
         */ $validator = \Validator::make(\Request::all(), array(
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'job_id' => 'required|unique:users',
                    'email' => 'required|unique:users',
                    'national_id' => 'required|unique:users',
                    'designation' => 'required|integer',
                    'password' => 'required|confirmed|min:6',
                        )
        );
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator);
        } else {

            $data = \Request::all();
            $code = str_random(60);
            $user = User::create([
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'national_id' => $data['national_id'],
                        'job_id' => $data['job_id'],
                        'designation_id' => $data['designation'],
                        'code' => $code,
                        'status' => 0,
                        'phone_no' => $data['phone_no'],
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
            ]);

            if ($user) {
                //Send activation link
                $mail = Mail::pretend();
//            $mail = Mail::send('emails.auth.activate', array(
//                        'link' => route('account-activate', $code),
//                        'name' => $data['first_name']), function($message) use ($user) {
//                        $message->to($user->email, $user->first_name)->subject('Activate your account');
//                    });
                if ($mail) {
                    return redirect('/admin/add-user')
                                    ->with('global', '<div class="alert alert-success" align="center">Account activation link has been sent to user email.</div>');
                } else {
                    return redirect('/admin/add-user')
                                    ->with('global', '<div class="alert alert-warning" align="center">Activation link could not be sent to the user email. Please resend the activation link</div>');
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
