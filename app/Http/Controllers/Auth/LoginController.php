<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
         ]);
            $credential = ['username' => $request->username, 'password' => $request->password];
            $checkAuth = auth()->guard('web');
            if ($checkAuth->attempt($credential) == 1) {
                // $id = Auth::user()->user_role;
                if (Auth::user()->user_role == 1){
                    return redirect()->route('category.create');
                }
                if (Auth::user()->user_role == 2){
                    return redirect()->route('home');
                }
                if (Auth::user()->user_role == 3){
                    return redirect()->route('products.create');
                }
            }
            else{
                return back()->with('error', 'Email-Address Or Password Are Wrong.');
            }
}
}
