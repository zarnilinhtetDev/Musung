<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataApiController extends Controller
{
    public function getData()
    {
        $sql = DB::select('SELECT time.time_name,time.status,line.line_id,line.line_name,data.data_id,data.user_id,data.time_id,data.line_id,data.target,data.actual_target,data.create_date,data.update_date FROM data,time,line WHERE time.time_id=data.time_id AND line.line_id=data.line_id');
        DB::disconnect('musung');
        return response()->json($sql);
    }
    public function postData(Request $request)
    {
        $user_id = $request->user_id;
        $time_id = $request->time_id;
        $line_id = $request->line_id;
        $target = $request->target;
        $actual_target = $request->actual_target;

        // $sql = DB::insert('INSERT INTO data (user_id,time_id,line_id,target,actual_target,create_date) VALUES (?,?,?,?,?,?)', [$user_id, $time_id, $line_id, $target, $actual_target, NOW()]);
        // DB::disconnect('musung');
        // if ($sql == true) {
        //     return response()->json(['success' => 'ok']);
        // }
    }
    public function putData(Request $request)
    {
        $user_id = $request->user_id;
        $time_id = $request->time_id;
        $line_id = $request->line_id;
        $target = $request->target;
        $actual_target = $request->actual_target;
        $data_id = $request->data_id;

        $sql = DB::update('UPDATE data SET user_id=?,time_id=?,line_id=?,target=?,actual_target=?,update_date=? WHERE data_id=?', [$user_id, $time_id, $line_id, $target, $actual_target, NOW(), $data_id]);
        DB::disconnect('musung');
        if ($sql == true) {
            return response()->json(['success' => 'ok']);
        }
    }
}
