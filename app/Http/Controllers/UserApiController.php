<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserApiController extends Controller
{
    public function getUser()
    {
        $sql = DB::select("SELECT id,name,username,password,email,role,line_id,active_status,is_delete,remark,created_at,updated_at FROM users ORDER BY id ASC");
        DB::disconnect('musung');
        if ($sql == true) {
            return response()->json($sql);
        }
    }
    public function postUser(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;
        $role = $request->role;
        $line_id = $request->line_id;
        $note = $request->note;
        $sql = DB::insert("INSERT INTO users (name,username,password,email,role,line_id,remark,created_at) VALUES (?,?,?,?,?,?,?,NOW())", [$name, $username, $password, $email, $role, $line_id, $note]);
        DB::disconnect('musung');
        if ($sql == true) {
            return response()->json(['create' => 'ok']);
        }
    }
    public function putUser(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;
        $role = $request->role;
        $line_id = $request->line_id;
        $note = $request->note;
        $id = $request->id;

        $sql = DB::update("UPDATE users SET name=?,username=?,password=?,email=?,role=?,line_id=?,remark=?,updated_at=? WHERE id=?", [$name, $username, $password, $email, $role, $line_id, $note, NOW(), $id]);
        DB::disconnect('musung');
        if ($sql == true) {
            return response()->json(['update' => 'ok']);
        }
    }
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $sql = DB::update("UPDATE users SET status=1 WHERE id=?", [$id]);
        DB::disconnect('musung');
        if ($sql == true) {
            return response()->json(['soft_delete' => 'ok']);
        }
    }
}
