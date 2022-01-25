<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }
    public function index()
    {

        $request = Request::create('/api/user', 'GET');
        // $request->headers->set('X-Authorization', 'wAH2k5uRc2Sgsz8gm3rdq0eEUHchz2syWHfLuLoCEWXpyCtkers4a1OeIGL1CST0');

        $response = Route::dispatch($request);

        $responseBody = $response->getContent();
        return view('acc_management.member', compact('responseBody'));
    }
    public function postUser()
    {
        $request = Request::create(
            '/api/user',
            'POST',
            [
                'name' => request()->get('name'),
                'username' => request()->get('username'),
                'password' =>  Hash::make(request()->get('password')),
                'email' => request()->get('email'),
                'role' => request()->get('role'),
                'line_id' => request()->get('line'),
                'note' => request()->get('note'),
            ]
        );
        $response = Route::dispatch($request);

        return redirect('/member');
    }
    public function putUser()
    {
        $name = request()->get('name');
        $username = request()->get('username');
        $password = request()->get('password');
        $password_2 = request()->get('password2');
        $email = request()->get('email');
        $role = request()->get('role');
        $line_id = request()->get('line');
        $note = request()->get('note');
        $user_id = request()->get('id');

        // $request = Request::create(
        //     '/api/user',
        //     'PUT',
        //     [
        //         'name' => "String",
        //         'username' => request()->get('username'),
        //         'password' =>  1234,
        //         'email' => request()->get('email'),
        //         'role' => request()->get('role'),
        //         'line_id' => request()->get('line'),
        //         'note' => request()->get('note'),
        //         'id' => request()->get('id'),
        //     ]
        // );
        // $response = Route::dispatch($request);

        if ($password_2 == "") {
            $sql = DB::update("UPDATE users SET name=?,username=?,password=?,email=?,role=?,line_id=?,note=?,updated_at=? WHERE id=?", [$name, $username, $password, $email, $role, $line_id, $note, NOW(), $user_id]);
            DB::disconnect('musung');
        }
        if ($password_2 != "") {
            $sql = DB::update("UPDATE users SET name=?,username=?,password=?,email=?,role=?,line_id=?,note=?,updated_at=? WHERE id=?", [$name, $username, $password_2, $email, $role, $line_id, $note, NOW(), $user_id]);
            DB::disconnect('musung');
        }

        return redirect('/member');
    }
    public function deleteUser()
    {
        $id = request()->get('id');

        $request = Request::create(
            '/api/user_delete',
            'PUT',
            [
                'id' => request()->get('id'),
            ]
        );
        $response = Route::dispatch($request);

        return redirect('/member');
    }
}
