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
                    'designation_id' => 'required|integer',
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
                        'job_id' => $data['job_id'],
                        'national_id' => $data['national_id'],
                        'designation_id' => $data['designation_id'],
                        'code' => $code,
                        'status' => 0,
                        'phone_no' => $data['phone_no'],
                        'email' => $data['email'],
                        'password' => \Hash::make($data['password']),
            ]);

            if ($user) {
                //Send activation link
                //$mail = Mail::pretend();
                $mail = Mail::send('auth.activate', array(
                            'link' => route('account-activate', $code),
                            'name' => $data['first_name'],
                            'email' => $data['email'],
                            'password' => $data['password']), function($message) use ($user) {
                            $message->to($user->email, $user->first_name)->subject('Activate your account');
                        });
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

    protected function editUser() {
        //dd(\Request::all());
        /*
         * Activation code
         */ $validator = \Validator::make(\Request::all(), array(
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                    'phone_no' => 'required',
                    'id' => 'required',
                    'designation_id' => 'required|integer',
                        )
        );

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator);
        } else {
            $data = \Request::all();
            $user = User::find($data['id'])
                    ->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'job_id' => $data['job_id'],
                'designation_id' => $data['designation_id'],
                'phone_no' => $data['phone_no'],
            ]);

            if ($user) {
                $user = $user = User::find($data['id']);
                //Send activation link
                //$mail = Mail::pretend();
                $mail = Mail::send('auth.update', array(
                            'name' => $data['first_name'],
                            'email' => $data['email']), function($message) use ($user) {
                            $message->to($user->email, $user->first_name)->subject('PLS Account Update');
                        });
                if ($mail) {
                    return redirect()->back()
                                    ->with('global', '<div class="alert alert-success" align="center">User account updated successfully.</div>');
                } else {
                    return redirect()->back()
                                    ->with('global', '<div class="alert alert-warning" align="center">User account update failed. Please try again</div>');
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
            if (\Request::get('job_id') == \Auth::user()->job_id) {
                return redirect('/admin/view-users')
                                ->with('global', '<div class="alert alert-warning">Whoooops, user can not delete him/herself</div>');
            }
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
        $users = User::with('roles', 'designation')->find(\Hashids::decode($id)[0]);
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

    public function postPrivileges() {
        $check = \App\User_role::where('user_id', \Auth::user()->id)
                        ->where('role_id', 1)->count();
        if ($check < 1) {
            return redirect('/admin/view-users')
                            ->with('global', '<div class="alert alert-warning">User does not have enough privileges to modify privileges or status!</div>');
        }
        if (\Request::get('user_id') == \Auth::user()->id) {
            return redirect('/admin/view-users')
                            ->with('global', '<div class="alert alert-warning">User can not modify his own privileges or status!</div>');
        }
        $status = User::where('id', \Request::get('user_id'))
                ->update(array(
            'status' => \Request::get('status')
                )
        );
        \App\User_role::where('user_id', \Request::get('user_id'))->delete();
        if ($status) {
            $privs = \Request::get('privilege');
            //dd($privs);
            foreach ($privs as $key => $value) {
                if ($value == 'Yes') {
                    $updated = \App\User_role::create(array(
                                'role_id' => $key,
                                'user_id' => \Request::get('user_id'),
                                'assigned_by' => \Auth::user()->id
                                    )
                    );
                } else {
                    $updated = TRUE;
                }
            }
        } else {
            return redirect('/admin/view-users')
                            ->with('global', '<div class="alert alert-warning">User privileges could not be updated</div>');
        }
        if ($updated) {
            return redirect('/admin/view-users')
                            ->with('global', '<div class="alert alert-success">User privileges successfully updated</div>');
        } else {
            return redirect('/admin/view-users')
                            ->with('global', '<div class="alert alert-warning">User privileges could not be updated</div>');
        }
    }

    public function getChangePassword() {
        return view('auth.change');
    }

    public function postChangePassword() {
        $validator = \Validator::make(\Request::all(), array(
                    'current_password' => 'required',
                    'password' => 'required|confirmed|min:6',
                        )
        );
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator);
        }
        $current = \Request::get('current_password');
        if (\Auth::attempt(['email' => \Auth::user()->email, 'password' => $current])) {
            $user = \App\User::findOrFail(\Auth::user()->id);

            // Validate the new password length...

            $user->fill([
                'password' => \Hash::make(\Request::get('password'))
            ])->save();
            if ($user) {
                return redirect('/home')
                                ->with('global', '<div class="alert alert-success" align="center">Password change successful.</div>');
            } else {
                return redirect('/home')
                                ->with('global', '<div class="alert alert-warning" align="center">Password change failed.</div>');
            }
        }
        return redirect()->back()
                        ->with('global', '<div class="alert alert-warning" align="center">Your current password is not correct.</div>');
    }

    public function viewCharges() {
        $charges = \App\Vehicle_type::with('charge')->get();
        return view('admin.view-charges', array('charge' => $charges));
    }

    public function editCharges() {
        $charges = \App\Vehicle_type::with('charge')->get();
        return view('admin.update-charges', array('charge' => $charges));
    }

    public function updateCharges() {
        if (isset($_POST['update'])) {
            // dd(\Request::all());
            $seat = \Request::get('seat');
            $std_fee = \Request::get('std_fee');
            $extra_fee = \Request::get('extra_fee');
            foreach ($seat as $key => $num) {
                $update = \App\Charge::where('type_id', $key)
                        ->update(array(
                    'standard_fee' => $std_fee[$key],
                    'extra_fee' => $extra_fee[$key],
                    'standard_seats' => $num,
                        )
                );
            }
            $charges = \App\Vehicle_type::with('charge')->get();
            if ($update) {
                return view('admin.view-charges', array('charge' => $charges))
                                ->with('global', '<div class="alert alert-success" align="center">Charges successfully update</div>');
            } else {
                return redirect('edit-charges', array('charge' => $charges))
                                ->with('global', '<div class="alert alert-warning" align="center">Charges cound not be update successfully</div>');
            }
        }
        if (isset($_POST['close'])) {
            return redirect('admin');
        }
    }

}
