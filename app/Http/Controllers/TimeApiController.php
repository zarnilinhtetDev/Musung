<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeApiController extends Controller
{
    public function getTime()
    {
        $sql = DB::select('SELECT time_id,time_name,status FROM time');
        DB::disconnect('musung');
        return response()->json($sql);
    }
    public function postTime(Request $request)
    {
        $time_name = $request->time_name;
        $status = $request->status;

        $sql = DB::insert('INSERT INTO time (time_name,status) VALUES (?,?)', [$time_name, $status]);
        DB::disconnect('musung');
        if ($sql == true) {
            return response()->json(['success' => 'ok']);
        }
    }
    public function putTime(Request $request)
    {
        $status = $request->status;
        $time_id = $request->time_id;

        $sql = DB::update('UPDATE time SET status=? WHERE time_id=?', [$status, $time_id]);
        DB::disconnect('musung');
        if ($sql == true) {
            return response()->json(['success' => 'ok']);
        }
    }
}
