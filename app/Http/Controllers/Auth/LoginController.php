<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    protected function redirectTo() {
        if (Auth::user()->hasanyrole('super-admin|admin') && Auth::user()->can('manage projects')) {
            return '/admin/dashboard';
        } elseif (Auth::user()->hasrole('manager') && Auth::user()->can('manage tasks')) {
            return '/manager/dashboard';
        } elseif (Auth::user()->hasrole('supervisor') && Auth::user()->can('manage assignments')) {
            return '/supervisor/dashboard';
        } elseif (Auth::user()->hasrole('member') && Auth::user()->can('publish assignments')) {
            return '/member/dashboard';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
