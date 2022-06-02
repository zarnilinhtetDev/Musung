<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    protected function authenticated($request, $user)
    {
        if ($user->is_delete == 0) {
            $sql = DB::table('users')->where('id', $user->id)->update(['active_status' => 0]);
            DB::disconnect('musung');
        }
        if ($user->is_delete == 1) {
            Auth::logout();
            return redirect(url('/'))->with('error', 'Your account has been deleted.');
        }
    }
    public function logout()
    {
        if (Auth::check()) {
            $sql = DB::table('users')->where('id', Auth::user()->id)->update(['active_status' => 1]);
            DB::disconnect('musung');
            Auth::logout();
            return redirect(url('/'));
        } else {
            return redirect(url('/'));
        }
    }
}
