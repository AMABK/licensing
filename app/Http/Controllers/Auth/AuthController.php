<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'national_id' => 'required|max:255|unique:users',
                    'job_id' => 'required|max:255|unique:users',
                    'phone_no' => 'required|max:15|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        /*
         * Activation code
         */
        $code = str_random(60);

        $user = User::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'national_id' => $data['national_id'],
                    'job_id' => $data['job_id'],
                    'designation' => $data['designation'],
                    'code' => $data['code'],
                    'status' => 0,
                    'phone_no' => $data['phone_no'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);

        if ($user) {
            //Send activation link
            //Mail::pretend();
            $mail = \Mail::send('emails.auth.activate', array(
                        'link' => route('account-activate', $code),
                        'name' => $data['first_name']), function($message) use ($user) {
                        $message->to($user->email, $user->first_name)->subject('Activate your account');
                    });
            if ($mail) {
                return redirect('/')
                                ->with('global', '<div class="alert alert-success" align="center">Account activation link has been sent to user email.</div>');
            } else {
                return redirect('/')
                                ->with('global', '<div class="alert alert-warning" align="center">Activation link could not be sent to the user email. Please resend the activation link</div>');
            }
        }
    }

    public function getActivate($code) {
        $user = User::where('code', '=', $code)->where('status', '=', 0);
        if ($user->count()) {
            $user = $user->first();
            /*
             * Update user to active state
             */
            $user->status = 1;
            $user->code = '';

            if ($user->save()) {
                return redirect()->guest('auth/login')
                                ->with('global', '<div class="alert alert-success" align="center">Account activated. You can now sign in!</div>');
            }
        }

        return redirect()->guest('auth/login')
                        ->with('global', '<div class="alert alert-danger" align="center">Account activation failed, please try again or contact the support team.</div>');
    }

}
