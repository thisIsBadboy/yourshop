<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming login request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);
    }

    public function index(){
        return view('login');
    }

    /**
     * Login for valid request
     */
    public function login(Request $request){
        $input = $request->input('form');
        $validation = $this->validator($input);

        if($validation->fails()){
            return back()->withInput();
        }

        $credentials = ['email'=>$input['email'], 'password'=>$input['password']];
        $remember = isset($input['remember']) ? true : false;

        if(!Auth::attempt($credentials, $remember)){
            return back();
        }

        return redirect('/business');
    }

    /**
     * Logout an user
     */
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
