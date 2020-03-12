<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this -> validate(request(),[
            'usuario'=> 'required|max:150|min:4',
            'password' => 'required|string'
        ]);


        if (Auth::attempt(['cs_name'=>$request->get('usuario'),'password'=>$request->get('password')]))
        {

            return redirect()->route('dashboard');
        }else {
            return back()->withErrors(['cal', 'upress']);
        }
    }

    public function username()
    {
        return 'cs_name';
    }
}
