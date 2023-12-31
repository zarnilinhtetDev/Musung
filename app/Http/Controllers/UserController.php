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
        $request2 = Request::create('/api/line', 'GET');
        // $request->headers->set('X-Authorization', 'wAH2k5uRc2Sgsz8gm3rdq0eEUHchz2syWHfLuLoCEWXpyCtkers4a1OeIGL1CST0');


        $response = Route::dispatch($request);
        $response2 = Route::dispatch($request2);

        $responseBody = $response->getContent();
        $responseBody2 = $response2->getContent();
        return view('acc_management.member', compact('responseBody', 'responseBody2'));
    }
    public function postUser()
    {
        $name = request()->get('name');
        $u_name = request()->get('username');
        $password = Hash::make(request()->get('password'));
        $email = request()->get('email');
        $role = request()->get('role');
        $line_id = request()->get('line');
        $note = request()->get('note');

        $sql = DB::insert("INSERT INTO users (name,username,password,email,role,line_id,active_status,is_delete,remark,created_at) VALUES (?,?,?,?,?,?,?,?,?,NOW())", [$name, $u_name, $password, $email, $role, $line_id, 1, 0, $note]);
        DB::disconnect('musung');
        if ($sql == true) {
            return redirect('/member');
        }
    }
    public function putUser()
    {
        $name = request()->get('name');
        $username = request()->get('username');
        $password = Hash::make(request()->get('password'));
        $password_2 = Hash::make(request()->get('password2'));
        $email = request()->get('email');
        $role = request()->get('role');
        $line_id = request()->get('line');
        $note = request()->get('note');
        $user_id = request()->get('id');

        if ($password_2 == "") {
            $sql = DB::update("UPDATE users SET name=?,username=?,password=?,email=?,role=?,line_id=?,remark=?,updated_at=? WHERE id=?", [$name, $username, $password, $email, $role, $line_id, $note, NOW(), $user_id]);
            DB::disconnect('musung');
        }
        if ($password_2 != "") {
            $sql = DB::update("UPDATE users SET name=?,username=?,password=?,email=?,role=?,line_id=?,remark=?,updated_at=? WHERE id=?", [$name, $username, $password_2, $email, $role, $line_id, $note, NOW(), $user_id]);
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
    public function undoUser()
    {
        $id = request()->get('id');

        $request = Request::create(
            '/api/user_undo',
            'PUT',
            [
                'id' => request()->get('id'),
            ]
        );
        $response = Route::dispatch($request);

        return redirect('/member');
    }
}
