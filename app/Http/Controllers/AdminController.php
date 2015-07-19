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
        //dd($this->generateSn());
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $designation = \App\Designation::all();
        return view('admin.add-user', array('designations' => $designation));
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
    public function show() {
        $users = User::with('designation')->get();
        //dd($users);
        return view('admin.view-users', array('user' => $users));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::find(\Hashids::decode($id));
        $designation = \App\Designation::all();
        return view('admin.edit-user', array('users' => $user, 'designations' => $designation));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update() {
        //dd(\Request::all());
        if (isset($_POST['delete'])) {
            if(\Request::get('job_id') == \Auth::user()->job_id){
                return redirect('/admin/view-users')
                                ->with('global', '<div class="alert alert-warning">Whoooops, user can not delete him/herself</div>');            }
            $select = $this->destroy(\Request::get('job_id'));
            if (!$select) {
                return redirect('/admin/view-users')
                                ->with('global', '<div class="alert alert-success">User successfully deleted</div>');
            } else {
                return redirect('/admin/view-users')
                                ->with('global', '<div class="alert alert-warning">Whoooops, user could not be deleted. Please try again!</div>');
            }
        }

        $update = User::where('job_id', \Request::get('job_id'))
                ->update(array(
            'first_name' => \Request::get('first_name'),
            'last_name' => \Request::get('last_name'),
            'phone_no' => \Request::get('phone_no'),
            'designation_id' => \Request::get('designation_id'),
        ));
        if ($update) {
            return redirect('/admin/view-users')
                            ->with('global', '<div class="alert alert-success">User details successfully updated</div>');
        } else {
            return redirect('/admin/view-users')
                            ->with('global', '<div class="alert alert-warning">Whoooops, your updates could not be saved. Please try again!</div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($job_id) {
        $select = User::where('job_id', $job_id)->delete();
    }

    public function viewPrivileges($id) {
        $privs = \App\Role::all();
        $users = User::with('roles', 'designation')->find(\Hashids::decode($id));
        //dd($users);
        //$user_privs = \App\User_role::where('user_id', \Hashids::decode($id));
        return view('admin.view-privileges', array('priv' => $privs, 'user' => $users));
    }

    public function viewDeletedUsers() {
        $deleted = User::onlyTrashed()->with('designation')->get();
        return view('admin.view-deleted-users', array('user' => $deleted));
    }

    public function restoreDeletedUser($id) {
        $restore = User::onlyTrashed()
                ->where('id', \Hashids::decode($id))
                ->restore();
        if ($restore) {
            return redirect('admin/view-users')
                            ->with('global', '<div class="alert alert-success">User successfully restored</div>');
        } else {
            return redirect('admin/view-users')
                            ->with('global', '<div class="alert alert-warning">User could not be restored</div>');
        }
    }

}
