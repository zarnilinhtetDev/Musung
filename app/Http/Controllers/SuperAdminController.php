<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_detail = User::select('id', 'name', 'username', 'role')->where('role', 99)->get();
        return view('superadmin.info', compact('user_detail'));
    }
    public function postSuperAdmin()
    {
        $name = request()->post('name');
        $u_name = request()->post('username');
        $password = Hash::make(request()->get('password'));
        $role = request()->get('role');

        $sql = User::insert(['name' => $name, 'username' => $u_name, 'password' => $password, 'role' => $role]);

        if ($sql == true) {
            return redirect('/superadmin');
        }
    }
}
