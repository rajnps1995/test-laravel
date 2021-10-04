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
    // protected $redirectTo = RouteServiceProvider::HOME;

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

        try {
            // if( $request->u_type=="C"){
            //     $u_type=3;
            //     $redirect_route = 'dashboard';
            // }
            // else if($request->u_type=="S"){
            //     $u_type=2;
            //     $redirect_route = 'dashboard';
            // }
            // else if($request->u_type=="A"){
            //     $u_type=1;
            //     $redirect_route = 'category.index';
            // }
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
        }
        catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
}
}
